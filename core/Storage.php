<?php
//Data save.
class Storage{

    private $nowModule;

    public function __construct($nowModule){
        $this->nowModule = $nowModule;
    }


    public function save($key = '', $value = ''){
        global $db;
        //Judge the key is existed or not.

            if($key != ''){
                $db->save_data($this->nowModule, $key, $value);
                return true;
            }else{
                return false;
            }

    }

    public function get($key = ''){
        global $db;
        if($key != ''){
            return $db->get_data($this->nowModule, $key);
        }else{
            return false;
        }
    }

    public function delete($key = ''){
        global $db;
        if($key != ''){
            return $db->delete_data($this->nowModule, $key);
        }else{
            return false;
        }
    }

    public function clean(){
        global $db;
        return $db->clean_data($this->nowModule);
    }
}