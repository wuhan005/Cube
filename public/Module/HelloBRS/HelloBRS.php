<?php
/*
Module Name: 你好，B★RS！
Description: 这不是普通的小工具，它代表着我高三后期时的精神支柱，浓缩成四个字：你好，B★RS。启用后，在本页面可以看到一句来自番剧《Black★Rock Shooter》的台词。
Icon: ticket-star
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.1
*/

class HelloBRS extends CubeModule{
    public function __construct(){
        parent::__construct();
    }

    public function HelloBRS(){
        $this->Load('main.php');
    }
}

