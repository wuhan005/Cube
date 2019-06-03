<?php
/*
Module Name: Data
Description: 小工具数据存储管理
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
Auth: Yes
*/

class Data extends CubeModule{

    public function __construct(){
        parent::__construct();

        // URL Router.
        $this->router['CleanData'] = 'cleanData';
    }

    public function Data(){
        // Judge the user login or not.
        if($this->mod->isLogin()){
            $storageDataList = $this->db->getStorageData();
            require_once('Data_mainpage.php');
        }else{
            redirect('/Account');
        }
    }


    public function cleanData(){
        global $mod;

        if($mod->isLogin()){
            global $db;
            if(isset($_GET['ModuleName'])){
                $db->clean_data($_GET['ModuleName']);
                redirect('/Data');
            }

        }else{
            redirect('/Account');
        }
    }
}
