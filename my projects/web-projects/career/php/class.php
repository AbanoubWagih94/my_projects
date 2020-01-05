<?php
session_start();
error_reporting(0);
class conn{
    private static $con='';
    private static $exdb='';
    private static $host = 'localhost';
    private static $user = 'lotussol_abanoub';
    private static $pw = 'Abanoub123456';
    private function __construct(){}
    public static function conn($db){
        if(conn::$con=='' || $db!=conn::$exdb){
            try{
                $x = conn::$host;
                conn::$con = new PDO("mysql:host=$x;dbname=$db",conn::$user,conn::$pw, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ));
                conn::$exdb = $db;
                return conn::$con;
            }
            catch(PDOException $e){
                echo 'connection Error';
            }
        }
    }
}

$db = conn::conn('lotussol_career');

class db{

    private function __construct(){}

    public static function select_all($t, $c, $order = "ORDER BY id DESC"){
        global $db;
        $q = "SELECT * FROM $t WHERE ".$c.' '.$order;
        try{

               $r = $db->query($q);
               return $r->fetchAll();
           }
        catch(PDOException $e){
            echo 'Connection Error';
        }
    }

    public static function select_condition($l, $t, $c, $order = "ORDER BY id DESC"){

        global $db;
        $q = "SELECT $l FROM $t WHERE ".$c.' '.$order;
        try{
            $r = $db->query($q);
         	return $r->fetchAll();
        }
        catch(PDOException $e){
            echo 'Connection Error';
        }
    }

    public static function update($t, $c, $arr){

        global $db;
        $u = '';

        foreach ($arr as $key => $value) {
            $u .= $key.'=\''.$value.'\' , ';
        }

        $s = substr($u, 0,count($u)-3);
        $q = "UPDATE $t SET  $s WHERE ".$c;
        try{
            $r = $db->query($q);
            return $r;
        }
        catch(PDOException $e){
            echo "Connection Error";
        }
    }

    public static function delete($t, $c){
        global $db;
        $q = "DELETE FROM $t WHERE ".$c;
        try{
            $r = $db->query($q);
            return $r;
        }
        catch(PDOException $e){
            echo 'Connection Error';
        }
    }


    public static function insert($t, $arr){
        global $db;
        $u = '';
        foreach ($arr as $key => $value) {
            $u .= $key.'=\''.$value.'\' , ';
        }
        $s = substr($u, 0,count($u)-3);
        $q = "INSERT INTO $t SET $s";
        try{
            $r = $db->query($q);
         	return $r;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
     	
    }
}