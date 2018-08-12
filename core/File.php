<?php
//Manage the file system.
class File{
    public static function deleteModule($moduleName){
        $dirName = $_SERVER["DOCUMENT_ROOT"] . "/Module/$moduleName";
        if ($handle = opendir("$dirName")) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..'){
                    if (is_dir("$dirName/$item")) {
                        self::deleteModule("$dirName/$item");
                    } else {
                        unlink("$dirName/$item");
                    }
                }
            }
            closedir($handle);
            return rmdir($dirName);
        }
    }
}