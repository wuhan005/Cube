<?php
/*
Module Name: Manager
Description: 管理每一个小工具
Author: John Wu
Author URI: Link to the author's web site
Version: 1.0.0
*/

require_once('core/ModuleFinder.php');
require_once('core/ModuleLoader.php');
require_once('core/File.php');

$mFinder = new ModuleFinder();
$moduleList = $mFinder->getModuleList();

$mLoader = new ModuleLoader();  //Used to load the single module.

$onModule = $db->getOnModule();

$moduleDetailList = array();

foreach($moduleList as $value){
    $mLoader->Init($value); 
    $moduleInfo = $mLoader->module;
    //Add the Module is START or not info.
    $moduleInfo['isStart'] = in_array($mLoader->module['PathName'],$onModule);

    $moduleDetailList[] = $moduleInfo;  //Add the single module's info to the detail list.
}

function startModule(){
    global $db;
    global $mLoader;

    if(isset($_GET['moduleName'])){
        $db->startModule($_GET['moduleName']);
        showNotice('success','成功！',$_GET['moduleName'] . ' 已启用。');
        $mLoader->initModule($_GET['moduleName']);
    }else{
        //Missing the module name, turn error.
        showNotice('danger','警告！','缺少参数！');
    }
}

function offModule(){
    global $db;

    if(isset($_GET['moduleName'])){
        $db->offModule($_GET['moduleName']);
        showNotice('success','成功！',$_GET['moduleName'] . ' 已关闭。');
    }else{
        //Missing the module name, turn error.
        showNotice('danger','警告！','缺少参数！');
    }
}

function deleteModule($moduleName = ''){
    global $db;
    $onModuleList = $db->getOnModule();
    if(isset($_GET['moduleName'])){
        //Judge the module is off or not.
        if(in_array($_GET['moduleName'], $onModuleList)){
            showNotice('danger','警告！','检测到小工具 '. $_GET['moduleName'] .' 未关闭，请关闭后再删除。');
        }else{
            //Delete the moudle folder.
            if(File::deleteModule($_GET['moduleName'])){
                refresh();
            }else{
                //Delete Error.
                //alert('danger','警告！','删除失败！');
            }
        }
    }else{
        //Missing the module name, turn error.
        showNotice('danger','警告！','缺少参数！');
    }
}

//ACTIONS HERE.
//Judge if there is an action parameter.
if(isset($_GET['action'])){
    global $mod;
    //Judge the user is log in or not.
    if($mod->isLogin()){
        switch($_GET['action']){
            case 'startModule':
            startModule();
            break;
            case 'offModule':
            offModule();
            break;
            case 'deleteModule':
            deleteModule();
            break;
        }
    }else{
        redirect('/Manager');
    }
}

function dropdown($PathName,$isStart){
    global $mod;
    //Judge the user is log in or not.
    if($mod->isLogin()){
        //Judge the UI.
        if($isStart){
            $buttomLabel = '启用';
            $dropitemLabel = '关闭';
            $dropitemURL = '?action=offModule&moduleName=' . $PathName;
        }else{
            $buttomLabel = '关闭';
            $dropitemLabel = '启用';
            $dropitemURL = '?action=startModule&moduleName=' . $PathName;
        }
        
        echo('
        <div class="btn-group btn-hspace">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">' . $buttomLabel . '<span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <div class="dropdown-menu" role="menu">
            <button class="btn btn-space md-trigger dropdown-item" data-modal="full-danger" onClick="reDelete(\'' . $PathName . '\')">删除</button>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="' . $dropitemURL . '">' . $dropitemLabel . '</a>
            </div>
        </div>
        ');
    }
}

//Load the mainpage.
require_once('Manager_mainpage.php');