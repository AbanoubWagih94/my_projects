<?php
    define("__CONFIG__", true);
    require_once "inc/config.php";
    Page::ForceLogout();
    $user = new User($_SESSION['user_id']);
    $books = Book::getAll();
    $categories = Category::getAll();


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="follow" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="assets/Libs/bootstrap/css/bootstrap.min.css" />
    </head>
    <body >
        <div id="book_container">
            <div id="categories" class="container">
                <div id="categories_list" >
                    <h3>Categories:</h3>
                    <ul id="list">
                        <?php
                        foreach ($categories as $category){
                            ?>
                            <li class="list"><a href="#" class="link" onclick="Show(<?php echo $category->category_id; ?>);"> <?php echo $category->category_name; ?> </a>
                                <ul class="sub_list" id="<?php echo $category->category_id; ?>" style="display:none;">
                                    <?php
                                    foreach ($books as $book){
                                        ?>
                                        <?php if ($book->category_id === $category->category_id){?><li><a href="#" onclick="readBook('<?php
                                            echo $book->book_url; ?>');"> <?php echo $book->book_name; ?> </a></li><?php }?>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <div id="addBook">
                    <button type="click" class="btn btn-outline-light" onclick="bookForm('Show')">
                        Add Book
                    </button>

                </div>
            </div>

            <div id="book_frame" class="container-fluid text-center">

                <div id="book_form">
                    <button type="button"  class="close" aria-label="Close" onclick="bookForm('none');">
                        <span aria-hidden="true" style="color: #ec2147;">&times;</span>
                    </button>
                    <form class="js-addBook"  name="addbook" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <input type="text" class="form-control" id="category" required>
                        </div>
                        <div class="form-group">
                            <label for="bookname">Book name:</label>
                            <input type="text" class="form-control"  id="bookname" required>
                        </div>

                        <div class="form-group">
                            <label for="book">Choose your book:</label>
                            <input type="file" class="form-control-file"  id="book" required>
                        </div>
                        <button type="submit" class="btn btn-outline-light">Submit</button>
                    </form>
                </div>
                <div id="iframe">
                    <button type="button" id="close_btn" class="close" aria-label="Close" onclick="hideIframe();">
                        <span aria-hidden="true" style="color: #ec2147;">&times;</span>
                    </button>
                    <iframe   id="IFRAME" frameborder="1" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <?php require_once "inc/footer.php"?>
    </body>
</html>

