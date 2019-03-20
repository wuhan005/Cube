<?php
/*
Module Name: Security
Description: Cube 安全设置相关
Author: John Wu
Author URI: https://github.red/
Version: 1.0.0
*/

require_once(COREPATH . '/core/vendor/GoogleAuthenticator.php');

class Security extends CubeModule{

    private $ga;

    public function __construct(){
        parent::__construct();
        $this->router['OpenGoogleAuth'] = 'open_google_auth';
        $this->router['CloseGoogleAuth'] = 'close_google_auth';

        $this->ga = new PHPGangsta_GoogleAuthenticator();
    }

    public function Security(){
        global $db;
        $gaAuth = $db->getSetting('GAAuth');
        require_once('Security_mainpage.php');
    }

    // Open GA
    public function open_google_auth(){
        global $db;
        $ga_key = $db->getSetting('GAAuth');

        if($ga_key === ''){
            $secret = $this->ga->createSecret();    //Create new key.

            $data = array(
                'secret' => $secret,
                'url' => $this->ga->getQRCodeGoogleUrl('Cube', $secret)
            );

            $db->updateSetting(array(
                'GAAuth' => json_encode($data)
            ));

            redirect('/Security');
        }
    }

    // Close GA
    public function close_google_auth(){
        global $db;

        $db->updateSetting(array(
            'GAAuth' => ''
        ));

        redirect('/Security');
    }
}

