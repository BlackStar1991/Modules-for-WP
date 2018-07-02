<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 21.06.2018
 * Time: 12:55
 */
class SettingsTable
{
    protected $IconsImageDirectory;
    protected $CasinosImageDirectory;
    protected $ShowColumns;
    protected $QueueColumn;

    function __construct()
    {
        global $wpdb;
        $casinos_setings = $wpdb->prefix . 'casinos_setings';
        $Settings = $wpdb->get_row("SELECT * FROM $casinos_setings", ARRAY_A);
        $this->IconsImageDirectory = $Settings['IconsImageDirectory'];
        $this->CasinosImageDirectory = $Settings['CasinosImageDirectory'];
        $this->ShowColumns = explode(",", $Settings['ShowColumns']);
        $this->QueueColumn = explode(",", $Settings['QueueColumn']);
    }


    /**
     * @return array
     */
    public function getShowColumns()
    {
        return $this->ShowColumns;
    }

    /**
     * @return mixed
     */
    public function getIconsImageDirectory()
    {
        return $this->IconsImageDirectory;
    }

    /**
     * @return mixed
     */
    public function getCasinosImageDirectory()
    {
        return $this->CasinosImageDirectory;
    }

    /**
     * @return array
     */
    public function getQueueColumn()
    {
        return $this->QueueColumn;
    }


}