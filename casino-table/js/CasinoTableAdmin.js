window.onload = function () {

    var body = $("body"),
        casinoTable = $(".table_casino"),

        currentThead = $(".table_casino thead tr"),
        currentTrBody = $(".table_casino tbody tr"),
        lengthOfWorkColumn = $(".th_but").length,
        checkedCheckBoxes = [],

        locationURL = document.location.href.split("/wp-admin/");

    uploadPhoto();
    // Добавление ряда с казино
    body.on("click", ".btn_addNewCasino", function () {

        var indexCurrentRow = $(this).closest('tr').index(),
            currentContentInRow = casinoTable.find("tbody tr").eq(indexCurrentRow).html(),
            currentRow = casinoTable.find("tbody tr").eq(indexCurrentRow);

        currentRow.after('<tr>' + currentContentInRow + '</tr>');

        var nextRow = $(".table_casino").find("tbody tr").eq(indexCurrentRow + 1);

        rowNumbering();

        nextRow.find(".table_casino__uploadImg_text").text("Файл не выбран");
        nextRow.find("input[type='text']:not('.custoom_button__name')").val("");
        nextRow.find("input[type='url']").val("");
        nextRow.find(".th_manufacturers select").attr("name", "manufacturers[][]");
        nextRow.find(".th_currencies select").attr("name", "currencies[][]");
        nextRow.find("textarea").empty();

        var noImgUrl = locationURL[0] + "/wp-content/plugins/casino-table/img/casinos/no-image.jpg"; // подставляем no-img картинку
        nextRow.find(".table_casino__uploadImg_image").attr('src', noImgUrl);

    });

    // Задание значения val из js_casinoName для полей manufacturers и currencies
    body.on("blur", ".js_casinoName", function () {
        var currentVal = $(this).val();
        $(this).closest('tr').find(".th_manufacturers select").attr("name", "manufacturers['" + currentVal + "'][]");
        $(this).closest('tr').find(".th_currencies select").attr("name", "currencies['" + currentVal + "'][]");
    });

    /// Проверка на запрещенные символы для js_casinoName
    body.on("keyup", ".js_casinoName", function () {
            var value = $(this).val();
            value = value.replace(new RegExp('\'', 'g'), '');
            value = value.replace(new RegExp('"', 'g'), '');
            value = value.replace(new RegExp('`', 'g'), '');
            $(this).val(value)
        }
    );


    // Удаления ряда с казино
    body.on("click", ".button_del_row", function () {

        var currentRowWithThisButton = $(this).closest('tr'),
            currentRowIndex = currentRowWithThisButton.index();

        if (currentRowIndex !== 0) {
            $(this).closest('tr').remove();
        }

        rowNumbering();

    });

    function rowNumbering() {
        casinoTable.find(".td_number").each(function (index) {
            $(this).text(index + 1);
        });
    }


    /// Кнопка переключения текущей колонки таблици с предыдущей
    body.on("click", ".btn_prev_colum", function () {

        var indexCurrentColumn = $(this).closest('.th_but').index(),

            prevIndex = indexCurrentColumn - 1;

        if (prevIndex === 0) {
            prevIndex = lengthOfWorkColumn;
        }

        exchangeContentInColumns(indexCurrentColumn, prevIndex, currentThead, "th");
        exchangeContentInColumns(indexCurrentColumn, prevIndex, currentTrBody, "td");

        checkForEnterCheckbox()

    });

    /// Кнопка переключения текущей колонки таблици со следующей
    body.on("click", ".btn_next_colum", function () {

        var indexCurrentColumn = $(this).closest('.th_but').index(),
            nextIndex = indexCurrentColumn + 1;
        if (nextIndex === lengthOfWorkColumn + 1) {
            nextIndex = 1;
        }

        exchangeContentInColumns(indexCurrentColumn, nextIndex, currentThead, "th");
        exchangeContentInColumns(indexCurrentColumn, nextIndex, currentTrBody, "td");
        checkForEnterCheckbox()
    });

    // Магия перемещения, колонок !
    function exchangeContentInColumns(currentIndex, workerIndex, myWorkerFild, nameCell) {
        var currentArr = [],
            workerArr = [];

        myWorkerFild.each(function () {
            currentArr.push($(this).find(nameCell).eq(currentIndex).html());
        });
        myWorkerFild.each(function () {
            workerArr.push($(this).find(nameCell).eq(workerIndex).html());
        });

        myWorkerFild.each(function (index) {
            $(this).find(nameCell).eq(currentIndex).html(workerArr[index]);
        });
        myWorkerFild.each(function (index) {
            $(this).find(nameCell).eq(workerIndex).html(currentArr[index]);
        });
    }

    AddAncheckBeackgraund();

    function AddAncheckBeackgraund() {
        var arr = $("#js-showColumns").val().split(',');
        $(".bl_checkedColumn__checkbox").each(function () {
            var indexCurrentColumn = $(this).closest('.th_but').index();
            if (arr.indexOf($(this).val()) >= 0) {
                $(this).attr("checked");
                $(".table_casino thead tr:nth-of-type(2)").find("th").eq(indexCurrentColumn).removeClass("filter_unchecked");
                currentTrBody.each(function () {
                    $(this).find("td").eq(indexCurrentColumn).removeClass("filter_unchecked");
                });

            } else {
                $(this).removeAttr("checked");
                $(".table_casino thead tr:nth-of-type(2)").find("th").eq(indexCurrentColumn).addClass("filter_unchecked");
                currentTrBody.each(function () {
                    $(this).find("td").eq(indexCurrentColumn).addClass("filter_unchecked");
                });
            }

        });
    }

    // Проверка нажатых checkbox-ов. Перезапись значений value
    function checkForEnterCheckbox() {

        checkedCheckBoxes = [];
        var showColumns = [];
        var queueColumn = [];
        $(".bl_checkedColumn__checkbox").each(function (i) {
            queueColumn.push($(this).val());
            if ($(this).prop("checked")) {
                checkedCheckBoxes.push(i + 1);
                showColumns.push($(this).val());
            }
        });

        $("#js-showColumns").val(showColumns);
        $("#js-queueColumn").val(queueColumn);
        AddAncheckBeackgraund()
    }


    body.on("click", ".bl_checkedColumn__checkbox", function () {
        checkForEnterCheckbox();
    });


    /// Обновление фотографии и подписи без отправки на сервер
    function uploadPhoto() {
        body.on("change", ".table_casino__uploadImg_upload", function () {

            var file = $(this).prop('files')[0];
            var preview = $(this).siblings('.table_casino__uploadImg_image');
            var reader = new FileReader();
            reader.onloadend = function () {
                preview.attr("src", reader.result);
            };
            if (file) {
                reader.readAsDataURL(file);
                $(this).prev(".table_casino__uploadImg_text").text(file.name);
            }
        }).change();
        $(window).resize(function () {
            $(".table_casino__uploadImg_upload").triggerHandler("change");
        });

    }


};