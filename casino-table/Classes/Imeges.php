<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 23.06.2018
 * Time: 10:38
 */

class Imeges
{
    protected $casinosDir;
    protected $iconsDir;
    protected $casinosURL;
    protected $IconsUrl;

    public function __construct()
    {
        $Params = new SettingsTable();
        $this->iconsDir = $Params->getIconsImageDirectory();
        $this->casinosDir = $Params->getCasinosImageDirectory();
    }

    /**
     * @param $casino
     * @val string
     * @return ImegesUrl
     */
    public function CasinoImg($casino)
    {
        $casino = translit($casino);
        $dir = plugin_dir_path(__FILE__) . '../img/casinos/';
        $format = ['jpg', 'png'];
        $this->casinosURL = $this->casinosDir . 'no-image.jpg';
        for ($i = 0; $i < count($format); $i++) {
            $file = $dir . translit($casino) . '.' . $format[$i];
            if (file_exists($file)) {
                $this->casinosURL = $this->casinosDir . $casino . '.' . $format[$i];
                return $this->casinosURL;
            }
        }
        return $this->casinosURL;
    }

    public function IconsUrl ($icins){
        $dir = plugin_dir_path(__FILE__) . '../img/slot-icons/';
        $format = ['jpg', 'png'];
        $this->IconsUrl = $this->iconsDir.'no-image.png';
        for ($i = 0; $i < count($format); $i++) {
            $file = $dir . $icins . '.' . $format[$i];
            if (file_exists($file)) {
                $this->casinosURL = $this->iconsDir . $icins . '.' . $format[$i];
                return $this->casinosURL;
            }
        }
        return $this->IconsUrl;
    }
}