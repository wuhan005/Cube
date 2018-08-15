<?php 
// Public Method

class Method{

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

}