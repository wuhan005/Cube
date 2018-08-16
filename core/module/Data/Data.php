<?php
/*
Module Name: Data
Description: 小工具数据存储管理
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
*/


// URL Router.
$this->router['CleanData'] = 'cleanData'; 

// Judge the user login or not.
if($mod->isLogin()){
    $storageDataList = $db->getStorageData();
    require_once('Data_mainpage.php');
}else{
    redirect('/Account');
}

function cleanData(){
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