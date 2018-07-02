<?php

class BuildTable
{
    protected $Head;
    protected $Body;
    protected $Footer;
    protected $colums = [
        '' => '',
    ];

    function __construct($type = '')
    {
        $this->BuildTable($type);
    }


    /**
     * @param string $type role
     * @return string with a table
     */
    public function BuildTable($type = '')
    {
        $h = new HeadTable();
        $b = new BodyTable();
        $f = new FooterTable();
        $this->Head = $h->GetHeadTable($type);
        if ($type == 'admin') {
            $this->Body = $b->GetBodyTableAdmin();
        } else {
            $this->Body = $b->GetBodyTableFront();
        }
        $this->Footer = $f->GetFooterTable($type);
    }
}