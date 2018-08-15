<?php
/*
Module Name: Data
Description: 小工具数据存储管理
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
*/
if($mod->isLogin()){
    $storageDataList = $db->getStorageData();
    require_once('Data_mainpage.php');
}else{
    redirect('/Account');
}
