<?php

class ModuleSetting
{
    private $moduleName;

    public function Setting($_moduleName){
        $this->moduleName = $_moduleName;
    }

    public function add_setting($_moduleID, $_setting){
        global $db;
        return $db->add_setting($_setting);
    }

    public function get_setting($_name){
        global $db;
        return $db->add_setting($_name);
    }

    public function set_setting($_name, $_data){
        global $db;
        return $db->add_setting($_name, $_data);
    }
}