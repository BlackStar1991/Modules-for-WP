$(document).ready(function () {
    GetData();
    $('.js-get-data').change(function () {
        GetData();
    });

    function GetData() {
        var chooseType = $('#chooseType').val();
        var minusDeys = $('#minusDeys').val();
        var posts_per_page = $('#posts_per_page').val();
        $.ajax({
            type: "POST",
            data:{
                type: chooseType,
                Deys: minusDeys,
                posts: posts_per_page,
            },
            url: "/wp-content/plugins/PostModifiedDate/GetData.php",
            success: function (data) {
                $('#ResaltsPostModified').html(data);
            }
        });
    }
});
