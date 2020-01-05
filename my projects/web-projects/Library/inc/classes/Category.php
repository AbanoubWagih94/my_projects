<?php

if(!defined("__CONFIG__")){
    exit("You don\'t have config file");
}

class Category
{
    public static function findCategory($category, $return_assoc = false){
        $con = DB::getConnection();
        $findCategory = $con->prepare("SELECT category_id FROM app_categories WHERE category_name = :category LIMIT 1");
        $findCategory->bindParam(":category",$category, PDO::PARAM_STR);
        $findCategory->execute();

        if($return_assoc) {
            return $findCategory->fetch(PDO::FETCH_OBJ);
        }

        $user_category = (bool) $findCategory->rowCount();
        return $user_category;
    }

    public static function getAll(){
        $con = DB::getConnection();
        $findCategory = $con->prepare("SELECT * FROM app_categories ");
        $findCategory->execute();

        $category = $findCategory->fetchAll(PDO::FETCH_CLASS |PDO::FETCH_PROPS_LATE, get_called_class());
        return $category;
    }

    public static function addCategory($category){
        $con = Db::getConnection();
        $newCategory = $con->prepare("INSERT INTO app_categories (category_name, user_id) VALUES(LOWER(:category_name), :user_id)");
        $newCategory->bindParam(":category_name",$category, PDO::PARAM_STR);
        $newCategory->bindParam(":user_id",$_SESSION['user_id'], PDO::PARAM_INT);
        $newCategory->execute();
    }
}