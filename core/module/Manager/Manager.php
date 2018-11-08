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

class Manager extends CubeModule{

    private $mLoader;
    private $mFinder;
    private $moduleDetailList;

    public function __construct(){
        parent::__construct();

        $this->mFinder = new ModuleFinder();
        $this->mLoader = new ModuleLoader();
        $moduleList = $this->mFinder->getModuleList();

        $onModule = $this->db->getOnModule();

        $this->moduleDetailList = array();

        foreach($moduleList as $value){
            $this->mLoader->Init($value);
            $moduleInfo = $this->mLoader->module;
            //Add the Module is START or not info.
            $moduleInfo['isStart'] = in_array($this->mLoader->module['PathName'],$onModule);

            $this->moduleDetailList[] = $moduleInfo;  //Add the single module's info to the detail list.
        }

        $this->router['UploadModule'] = 'upload_module';
    }

    public function Manager(){
        //ACTIONS HERE.
        //Judge if there is an action parameter.
        if(isset($_GET['action'])){
            global $mod;
            //Judge the user is log in or not.
            if($mod->isLogin()){
                switch($_GET['action']){
                    case 'startModule':
                        $this->startModule();
                        break;
                    case 'offModule':
                        $this->offModule();
                        break;
                    case 'deleteModule':
                        $this->deleteModule();
                        break;
                }
            }else{
                redirect('/Manager');
            }
        }

        //Load the mainpage.
        require_once('Manager_mainpage.php');
    }

    public function upload_module(){
        if($this->mod->isLogin()){
            File::uploadModule($_FILES['fileUploader']);
        }
        redirect('/Manager');
    }

    private function startModule(){
        global $db;

        if(isset($_GET['moduleName'])){
            $moduleName = $_GET['moduleName'];

            $db->startModule($moduleName);

            //Init the module.
            require_once(BASEPATH . "/Module/$moduleName/$moduleName.php");
            $cubeModule = new $moduleName();
            $cubeModule->Storage = new Storage($moduleName);
            $cubeModule->__Init();

            showNotice('success','成功！',$_GET['moduleName'] . ' 已启用。');
        }else{
            //Missing the module name, turn error.
            showNotice('danger','警告！','缺少参数！');
        }
    }

    private function offModule(){
        global $db;

        if(isset($_GET['moduleName'])){
            $db->offModule($_GET['moduleName']);
            showNotice('success','成功！',$_GET['moduleName'] . ' 已关闭。');
        }else{
            //Missing the module name, turn error.
            showNotice('danger','警告！','缺少参数！');
        }
    }

    private function deleteModule($moduleName = ''){
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

    private function dropdown($PathName,$isStart){
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
            <button class="uk-button uk-button-default" type="button">已' . $buttomLabel . '</button>
            <div uk-dropdown>
                <ul class="uk-nav uk-dropdown-nav">
                    <li><a href="' . $dropitemURL . '">' . $dropitemLabel . '</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a onClick="reDelete(\'' . $PathName . '\')" uk-toggle="target: #SureDeleteModal" href="#" >删除</a></li>
                </ul>
            </div>
            ');
        }
    }


}
