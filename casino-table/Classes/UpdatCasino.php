<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 25.06.2018
 * Time: 09:47
 */

class UpdatCasino
{

    protected $CasinosTable;
    protected $BD;

    public function __construct()
    {
        global $wpdb;
        $this->BD = $wpdb;
        $this->CasinosTable = $wpdb->prefix . 'casinos';
    }

    public function DelateCasino($id)
    {
        $this->BD->query("DELETE FROM `$this->CasinosTable` WHERE `id` = $id");
    }

    /**
     * @param $name string
     * @return bool
     */
    public function IsUniquetCasinoName($name)
    {
        $this->BD->get_results("SELECT * FROM `$this->CasinosTable` WHERE `name` LIKE '$name'");
        if ($this->BD->num_rows === 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $name ,$sub_name,$bonus,$wager,$evaluation,$bonus_type,$manufacturers,$currencies,$casinoURL,$casinoButtonName,
     * $verviewURL,$verviewButtonName,$reviewsURL,$reviewsButtonName
     * @return int|false Number of rows affected/selected or false on error
     */
    public function SaveCasino($name, $sub_name, $bonus, $wager, $evaluation, $bonus_type, $manufacturers, $currencies, $casinoURL, $casinoButtonName,
                               $verviewURL = '', $verviewButtonName = '', $reviewsURL = '', $reviewsButtonName = '')
    {
        global $wpdb;
        $table = $wpdb->prefix . 'casinos';
        $rezalt = $rezalt = $wpdb->query(
            "INSERT INTO `$table`
(`name`, `sub_name`, `bonus`, `wager`, `evaluation`, `bonus_type`, `manufacturers`, `currencies`, `casinoURL`, `casinoButtonName`, `verviewURL`, `verviewButtonName`, `reviewsURL`, `reviewsButtonName`) 
VALUES ('$name','$sub_name','$bonus','$wager','$evaluation','$bonus_type','$manufacturers','$currencies','$casinoURL','$casinoButtonName','$verviewURL','$verviewButtonName','$reviewsURL','$reviewsButtonName')"
        );
        return $rezalt;
    }
}