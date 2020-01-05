<?php

if(!defined("__CONFIG__")){
    exit("You don\'t have config file");
}
class Book
{
    private $con;

    public static function addBook($bookName, $url, $categoryId){
        $con = DB::getConnection();
        $newBook = $con->prepare("INSERT INTO app_books (book_name, book_url, user_id, category_id) VALUES(LOWER(:bookName), :url, :user_id, :category_id)");
        $newBook->bindParam(":bookName",$bookName, PDO::PARAM_STR);
        $newBook->bindParam(":url",$url, PDO::PARAM_STR);
        $newBook->bindParam(":user_id",$_SESSION['user_id'], PDO::PARAM_INT);
        $newBook->bindParam(":category_id",$categoryId, PDO::PARAM_INT);

        return $newBook->execute();
    }

    public static function getAll(){
        $con = DB::getConnection();
        $books = $con->prepare("SELECT * FROM app_books");
        $books -> execute();

        return $books->fetchAll(PDO::FETCH_CLASS |PDO::FETCH_PROPS_LATE, get_called_class());
    }
}