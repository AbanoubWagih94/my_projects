<?php
require_once "class.php";

define('PATH',realpath('../'));
define('IMG_PATH',PATH.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR);
define('SOUND_PATH',PATH.DIRECTORY_SEPARATOR.'sounds'.DIRECTORY_SEPARATOR);
define('FILE_PATH', PATH.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR);

class Controller{
    public static function uploadMedia($file){
       $name = $file['name'];
        $type = substr($name,strpos($name,'.')+1);
        $size = $file['size'];
        $tmp_name =  $file['tmp_name'];
        if($size < 3500000){
            if($type === 'png' || $type === 'jpg'){
                $path = IMG_PATH;
            }else if($type === 'mp3'){
                $path = SOUND_PATH;
            }else{
                $path = false;
                echo "uploading error please check the type mp3/jpg/png only";
                exit;
            }
                if(move_uploaded_file($tmp_name, $path.$name) && $path){
                    echo $name;
                }
                else{
                    echo "uploading error please check internet connection";
                    exit;
                }
        }else{
            echo "uploading error please check the size less than 3.5mb";
            exit;
        }

    }
    public static function getComplex($table, $file, $data1, $data2, $cond=1){

        $ret = array();
        $f = file_get_contents(FILE_PATH.$file);
        $d = db::select_all($table, $cond);
        
        if($f && isset($d)){
            $ret[$data1] = $d;
            $ret[$data2] = $f;
            echo json_encode($ret);
        }else{
            echo "error";
        }
    }
    public static function updateData($data, $id){

        $id = explode('/', $id);
        $id= $id[1];
        $data = json_encode($data);

        if(file_put_contents(FILE_PATH.$id, $data)){
            echo "ok";
        }else{
            echo "error";
        }
    }
    public static function getData($id){

        $id = explode('/', $id);
        $id = $id[1];
        if($data = file_get_contents(FILE_PATH.$id))
            echo $data;
        else
            echo "error";
    }

    public static function changeDataBase($table, $arr, $keys, $id = false, $retType = 1){

        $arr = self::setKeys($arr, $keys);
        $cond = "id";
        if(is_array($id)){
            $cond = $id[0];
            $id = $id[1];
        }

        if($id !== false)
            $res = db::update($table, $cond."='".$id."'", $arr);
        else
            $res = db::insert($table, $arr);

        if($res){
            if($retType === 1)
            {
                echo "ok";
            }else{
              return true;
            }
        }else{
            if($retType === 1)
            {
                echo "error";
            }else{
                return false;
            }
        }

    }

    public static function setKeys($arr, $keys){
        $ret = array();
        foreach ($keys as $key){
            $ret[$key] = $arr[$key];
        }
        return $ret;
    }

    public static function checkDataBase($res){
        if($res)
        {
            echo "ok";
        }
        else
        {
            echo "error";
        }
    }

    public static function signIn($name, $pw){
        $res = db::select_all('userdata',"(name='$name' OR mail='$name') AND password='$pw'");
        if(count($res) === 1){
            $_SESSION['user'] = $res;
            echo "ok";
        }else{
            echo "error";
            exit;
        }
    }
}

