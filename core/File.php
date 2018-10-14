<?php
//Manage the file system.
class File{
    public static function deleteModule($moduleName){
        $dirName = $_SERVER["DOCUMENT_ROOT"] . "/Module/$moduleName";
        if ($handle = @opendir("$dirName")) {
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

    public static function uploadModule($moduleInfo){

        //The promitted file type.

        $canUploadType = ['application/zip', 'application/x-zip-compressed', 'application/octet-stream', 'application/x-rar-compressed'];

        if(in_array($moduleInfo['type'], $canUploadType)){

            //Move the file into the 'Module' path.
            move_uploaded_file($moduleInfo["tmp_name"], BASEPATH . '/Module/' . $moduleInfo['name']);

            $moduleName = substr($moduleInfo['name'], 0, strlen($moduleInfo['name']) - 4);      //Remove the .zip / .rar

            $zip = new ZipArchive;
            if ($zip->open(BASEPATH . '/Module/' . $moduleInfo["name"]) === TRUE) {

                $zip->extractTo(BASEPATH . '/Module/'); //Extrace the file.
                $zip->close();

                unlink(BASEPATH . '/Module/' . $moduleInfo['name']);

                return true;

            } else {
                return false;
            }

        }else{
            return false;
        }

    }

}