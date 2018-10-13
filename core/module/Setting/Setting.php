<?php
/*
Module Name: Setting
Description: 在这里设定你的 Cube
Author: John Wu
Author URI: Link to the author's web site
Version: 1.0.0
*/

class Setting extends CubeModule{
    public function __construct(){
        //Register router
        $this->router['UpdateSettingAction'] = 'update_setting';
    }

    public function Setting(){
        global $mod;
        if($mod->isLogin()){
            global $db;

            //Main Pgae
            require_once('Setting_mainpage.php');
        }else{
            redirect('/Account');
        }
    }


    public function update_setting(){
        global $mod;
        if($mod->isLogin()){
            global $db;

            //Update the setting to the database.
            $db->updateSetting($_POST);
            redirect('/Setting');
        }else{
            redirect('/Account');
        }
    }

}


