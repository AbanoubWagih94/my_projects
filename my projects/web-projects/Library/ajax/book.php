<?php
    define("__CONFIG__", true);
    require_once "../inc/config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type:application/json');
        $return =[];

         $category = Filter::String($_POST['category']);
         $bookName = Filter::String($_POST['bookName']);
         $book = $_FILES['book']['error'];

         if($book > 0){
             $return['error'] = $book;
         } else {
             $findCategory = Category::findCategory($category, true);

             if (!file_exists('Library/uploads/'.$category)) {
                 mkdir('Library/uploads/'.$category, 0777, true);
             }

             $done = move_uploaded_file($_FILES['book']['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/library/ajax/Library/uploads/". $category. '/' . $_FILES['book']['name']);

             if($done) {

                 $url = "/library/ajax/Library/uploads/". $category. '/' . $_FILES['book']['name'];

                 if($findCategory){
                     $categoryId = $findCategory->category_id;
                     if (Book::addBook($bookName, $url, $categoryId)){
                         $return['book'] = "done";
                     }
                 } else {
                     Category::addCategory($category);
                     $categoryId = $con->lastInsertId();
                     if($categoryId){
                        if( Book::addBook($bookName, $url, $categoryId)) {
                            $return['book'] = "done";
                        }
                     }
                 }
             } else {
                 $return['error'] = "Invalid move";
             }
         }
        echo json_encode($return,JSON_PRETTY_PRINT);exit();
    } else {
        exit("Invalid URL");
    }
