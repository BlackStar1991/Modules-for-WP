<?php


/**
 * Class HeadTable
 * @return string with head table
 */
class HeadTable
{
    protected $HeadTable = '';
    protected $ThName = [
        'th_namber' => '№ п/п',
        'th_name' => 'Название казино',
        'th_bonus' => 'Бонус казино',
        'th_wager' => 'Вейджер',
        'th_evaluation' => 'Оценка казино',
        'th_bonus_type' => 'Тип бонусов',
        'th_manufacturers' => 'Производители',
        'th_currencies' => 'Игровые валюты',
        'th_buttons' => 'Кнопки',
        'buttons_actions' => 'Управление',
    ];
    public function __toString()
    {
        return $this->HeadTable;
    }

    /**
     * @param string $type role
     * @return string with table header by role
     */
    public function GetHeadTable($type = '')
    {
        $Params = new SettingsTable();
        $ParamsTh = $Params->getShowColumns();
        $QueueColumn = $Params->getQueueColumn();
        if ($type == 'admin') {
            $this->HeadTable = '<h1 class="table_casino__title">&#x1f0df; Таблицы Казино </h1><div class="table_casino__full">';
            $this->HeadTable .= '<ul class="table_casino__help"><li>*На визуальную часть будут выводиться только столбци с включенными галочками</li><li>*Для добавления Таблици Казино на нужную Страницу необходимо в поле Описания нужной Страници вставить шорткод <span class="table_casino__strong">[ShowTableFront]</span> </br> если есть необходимость встаить таблицу в php фаил, то добавлять через <span class="table_casino__strong"> &#60;?php do_shortcode(&quot;[ShowTableFront]&quot;); ?&#62; </span></li><li>*Что бы выбрать несколько значений из ячеек <span class="table_casino__strong">Производители</span> или <span class="table_casino__strong">Игровые валюты</span> зажмите Left Ctrl и нажмите на необходимые пункты</li><li>*Если необходимо добавить другие элементы в рубрику <span class="table_casino__strong">Производители</span> необходимо перейти в нужное подменю</li><li>*Желательно не выводить все колонки таблици по умолчанию, поскольку может нехватать места</li><li>!Убедитесь что у Вас отклёчен(или очищщен) кэш сайта, и сайт не подключен к dash.cloudflare.com(где отключено кэширование), иначе могут не отображатся изображения</li></ul>';
            $this->HeadTable .= '<form enctype="multipart/form-data" method="post">
            <button class="btn_submit" type="submit">Сохранить</button>';
        }
        $this->HeadTable .= '<div class="table_casino__wrapper"><table class="table_casino">
                                    <thead>
                                    <tr>';
        if ($type == 'admin') {
            $this->HeadTable .= '<th class="th_number"></th>';
            foreach ($QueueColumn as $Colum) {
                $on = 'checked';
                if (!in_array($Colum, $ParamsTh)) {
                    $on = null;
                }
                $this->HeadTable .= '<th class="th_but">
<button class="btn_prev_colum" type="button"></button>
<label class="bl_checkedColumn"><input class="bl_checkedColumn__checkbox" type="checkbox" '.$on.' value="'.$Colum.'"><p class="bl_checkedColumn__pointer"></p></label>
<button class="btn_next_colum" type="button"></button>
</th>';
            }
            $this->HeadTable .= '<th></th>';
            $this->HeadTable .= '</tr>';
            $this->HeadTable .= '<tr>';
            $this->HeadTable .= '<th class="th_number">№ п/п</th>';
            foreach ($QueueColumn as $IdTh) {
                $key = 'th_' . $IdTh;
                if (key_exists($key, $this->ThName)) {
                    $Name = $this->ThName[$key];
                } else {
                    $Name = 'Not find';
                }
                $this->HeadTable .= '<th class="th_' . $IdTh . '">' . $Name . '</th>';
            }
            $this->HeadTable .= '<th class="buttons_actions">Управление</th>';
        } else {
            foreach ($QueueColumn as $colum){
                if (in_array($colum,$ParamsTh)){
                    $key = 'th_' . $colum;
                    if (key_exists($key, $this->ThName)) {
                        $Name = $this->ThName[$key];
                    } else {
                        $Name = 'Not find';
                    }
                    $this->HeadTable .= '<th class="th_' . $colum . '">' . $Name . '</th>';
                }
            }
        }
        $this->HeadTable .= '</tr>
        </thead>';
//        var_dump($this->HeadTable);
        return $this->HeadTable;
//        return;
    }
}