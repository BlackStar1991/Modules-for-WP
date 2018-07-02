<?php


/**
 * Class BodyTable
 */
class BodyTable
{
    protected $BodyTable;
    protected $iconsDir;
    protected $casinosDir;
    protected $ParamsTh;
    protected $QueueColumn;
    protected $ThName = [
        'td_namber' => '№ п/п',
        'td_name' => 'Название казино',
        'td_bonus' => 'Бонус казино',
        'td_wager' => 'Вейджер',
        'td_evaluation' => 'Оценка казино',
        'td_bonus_type' => 'Тип бонусов',
        'td_manufacturers' => 'Производители',
        'td_currencies' => 'Игровые валюты',
        'td_buttons' => 'Кнопки',
        'td_actions' => 'Управление',
    ];

    public function __construct()
    {
        $Params = new SettingsTable();
        $this->iconsDir = $Params->getIconsImageDirectory();
        $this->casinosDir = $Params->getCasinosImageDirectory();
        $this->ParamsTh = $Params->getShowColumns();
        $this->QueueColumn = $Params->getQueueColumn();
    }

    /**
     * @return string with the table body for front
     */
    public function GetBodyTableFront()
    {

        global $wpdb;
        $Casinos = $wpdb->get_results("SELECT * FROM `wp_casinos`");
        $this->BodyTable = '';
        $this->BodyTable .= '    <tbody>';
        foreach ($Casinos as $casino) {
            $this->BodyTable .= '    <tr>';
            $content = new Content($casino->name);
            foreach ($this->QueueColumn as $Colum) {
                if (in_array($Colum, $this->ParamsTh)) {
                    $key = 'td_' . $Colum;
                    if (key_exists($key, $this->ThName)) {
                        $Name = $this->ThName[$key];
                    } else {
                        $Name = 'Not find';
                    }
                    $this->BodyTable .= '<td class="th_' . $Colum . '" data-title="' . $Name . '">';
                    if (method_exists($content, $Colum)) {
                        $this->BodyTable .= $content->$Colum($casino);
                    }
                    $this->BodyTable .= '</td>';
                }
            }
            $this->BodyTable .= '    </tr>';
        }
        $this->BodyTable .= '</tbody>';
        echo $this->BodyTable;
    }
    /**
     * @return string with the table body for admin
     */
    public function GetBodyTableAdmin()
    {
        global $wpdb;
        $Casinos = $wpdb->get_results("SELECT * FROM `wp_casinos`");
        $this->BodyTable = '';
        $this->BodyTable .= '    <tbody>';
        $n = 1;
        foreach ($Casinos as $casino) {
            $this->BodyTable .= '    <tr>';
            $this->BodyTable .= '<td class="td_number">' . $n . '</td>';
            $n++;
            $content = new Content($casino->name, 'admin');

            foreach ($this->QueueColumn as $IdTh) {
                $key = 'td_' . $IdTh;
                if (key_exists($key, $this->ThName)) {
                    $Name = $this->ThName[$key];
                } else {
                    $Name = 'Not find';
                }
                $this->BodyTable .= '<td class="th_' . $IdTh . '" data-title="' . $Name . '">';
                if (method_exists($content, $IdTh)) {
                    $this->BodyTable .= $content->$IdTh($casino);
                }
                $this->BodyTable .= '</th>';
            }
            $this->BodyTable .= '<td class="td_actions">' . $content->actions() . '</td>';
            $this->BodyTable .= '    </tr>';
        }
        echo $this->BodyTable;
    }
}