<?php 
// Public Method

class Method{

    private $current_user_data = '';
    private $db;

    //Sandbox. Private load database.
    private function db(){
        require_once('DataBase.php');
        $this->db = new DataBase;
        $this->db->Init();
    }

    public function __construct(){
        $this->db();    //Init the database.
    }

    //Remove the key in an array.
    public static function remove_key($data, $key){
        if(!array_key_exists($key, $data)){
            return $data;
        }
        $keys = array_keys($data);
        $index = array_search($key, $keys);
        if($index !== FALSE){
            array_splice($data, $index, 1);
        }
        return $data;
    }

    //URL router.
    public function get_current_page(){
        $urlPathInfo = @explode('/',$_SERVER['PATH_INFO']);
        if(@$urlPathInfo[2] != '')
            return @$urlPathInfo[2];
        else{
            return @$urlPathInfo[1];
        }
    }

    //Get now date.
    public static function get_date(){
        return date('Y-m-d h:i:s',time());
    }

    //Get module child page.
    public static function getChildPage(){
        //URL Router, used to load the second page in the module.
        $urlPathInfo = @explode('/', $_SERVER['PATH_INFO']);
        $nowPage = @$urlPathInfo[2];
        return $nowPage;
    }

    public function isLogin(){ 
        $nowName = @$_SESSION['AccountName'];
        $nowPasswd = @$_SESSION['AccountPasswd'];
    
        //Encrypt the password.
        $encryptNowPasswd = hash('sha256',$nowPasswd . $this->db->getSetting('Salt'));

        $realName = $this->db->getAccountData()['Account_Name'];
        $realPasswd = $this->db->getAccountData()['Account_Password'];
    
        return ($realName === $nowName AND $realPasswd === $encryptNowPasswd);
    }

    //Current user data, return isLogin, name, mail.
    public function get_current_login_user(){
        $data = [];
        if ($this->isLogin()){
            $data['isLogin'] = true;
            $data['name'] = $this->db->getAccountData()['Account_Name'];
            $data['mail'] = $this->db->getAccountData()['Account_Mail'];      
        }else{
            $data['isLogin'] = false;
            $data['name'] = '???';
            $data['mail'] = '';
        }
        return $data;
    }

    //Get gravatar data.
    public static function get_gravatar($email='', $size = 80) {
        
        //Use Qiniu CDN for Chinese users.
        $url = 'https://dn-qiniu-avatar.qbox.me/json/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= '.json';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $data = curl_exec($curl);

        //If the user's e-mail address doesn't have gravatar data, it will return 404 status.
        if($httpCode == 200) {
            $data = json_decode($data);

            $picURL = 'https://www.gravatar.com/avatar/';
            $picURL .= md5( strtolower( trim( $email ) ) );
            $picURL .= "?s=$size";

            $returnData['pic'] = $picURL;
            $returnData['name'] = $data->entry[0]->name->formatted;
            $returnData['url'] = $data->entry[0]->urls[0]->value;

        }else{
            $returnData['pic'] = '/static/img/avatar.png';
            $returnData['name'] = null;
            $returnData['url'] = '';
        }

        curl_close($curl);
        return $returnData;
    }

    //Generate key.
    public static function generateSalt($long = 64){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
        $max   = strlen( $chars ) - 1;
        $key = '';
        for ( $j = 0; $j < $long; $j++ ) {
            $key .= substr( $chars, mt_rand( 0, $max ), 1 );
        }

        return $key;
    }

}