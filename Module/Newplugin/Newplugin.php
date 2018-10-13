<?php
/*
Module Name: test module
Description: 测试
Icon: ticket-star
Author: John Wu
Author URI: Link to the author's web site
Version: 1.0.0
*/

class Newplugin extends CubeModule{

    public function __construct(){
        parent::__construct();
        $this->router['me'] = 'qqq';
    }

    public function __Init()
    {
        $this->Storage->save('aaa','adasd');

    }

    public function NewPlugin(){
        require_once('testpage.php');
    }

    public function qqq(){
        echo('yoyoyoyoyoyoyyo');
    }

}

