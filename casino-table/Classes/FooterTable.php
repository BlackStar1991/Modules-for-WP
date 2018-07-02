<?php

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 21.06.2018
 * Time: 11:33
 */
class FooterTable
{
    protected $FooterTable;

    public function GetFooterTable($type = '')
    {
        if ($type == 'admin') {
            $Params = new SettingsTable();
            $ParamsTh = implode(",", $Params->getShowColumns());
            $QueueColumn = implode(",", $Params->getQueueColumn());
            $this->FooterTable .= '
<input id="js-showColumns" type="hidden" name="ShowColumns" value="' . $ParamsTh . '"> 
<input id="js-queueColumn" type="hidden" name="QueueColumn" value="' . $QueueColumn . '">
</form>
</tbody>';
        }
        $this->FooterTable .= '</table>
                                </div>';
        echo $this->FooterTable;
        return;
    }
}