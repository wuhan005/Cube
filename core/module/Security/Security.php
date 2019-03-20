<?php
/*
Module Name: Security
Description: Cube 安全设置相关
Author: John Wu
Author URI: https://github.red/
Version: 1.0.0
*/

require_once(COREPATH . '/core/ModuleFinder.php');
require_once(COREPATH . '/core/ModuleLoader.php');

class Security extends CubeModule{


    public function __construct(){

        parent::__construct();


    }

    public function Security(){
        require_once('Security_mainpage.php');
    }
}

