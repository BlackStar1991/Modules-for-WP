<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 26.06.2018
 * Time: 10:56
 */

class PartnerIcons
{
    protected $Head;
    protected $Body;
    protected $Fooetr;

    public function __construct()
    {
        $this->BildHead();
        $this->BildBody();
        $this->BildFooetr();
    }

    public function __toString()
    {
        return $this->Head . $this->Body . $this->Fooetr;
    }

    protected function BildHead()
    {
        $this->Head = '<form enctype="multipart/form-data" method="post">
    <table>
        <thead>
        <tr>
            <td>Картинка</td>
            <td>Название</td>
            <td>Удалить</td>
        </tr>
        </thead>';
        return $this->Head;
    }

    protected function BildBody()
    {
        $Params = new SettingsTable();
        $iconsDir = $Params->getIconsImageDirectory();
        $this->Body = '<tbody>
        ';
        $dir = $_SERVER['DOCUMENT_ROOT'] . str_replace(home_url(), "", $iconsDir);
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            $this->Body .= '<tr>';
            $fileName = explode(".", $file)[0];
            if ($fileName=='no-image'){
                continue;
            }
            $this->Body .= '<td><img src="' .$iconsDir . $file . '" alt=""></td>
            <td>' . $fileName . '</td>
            <td><label>Удалить<input type="checkbox" value="' . $file . '" name="DeletePartner[]"></label></td>';
            $this->Body .= '</tr>';
        }
        $this->Body .= '<tr>
            <td>Добавить партнера</td>
            <td><input type="file" name="NewPartner"></td>
            <td><input type="text" name="NamePartner" placeholder="Имя производителя" required></td> 
                        </tr>';
        $this->Body .= '<tr>
            <td></td>
            <td></td>
            <td><button class="btn_submit" type="submit">Сохранить</button></td> 
                        </tr>';
        $this->Body .= '</tbody>';
        return $this->Body;
    }

    protected function BildFooetr()
    {
        $this->Fooetr = '    </table>
</form>';
        return $this->Fooetr;
    }
}