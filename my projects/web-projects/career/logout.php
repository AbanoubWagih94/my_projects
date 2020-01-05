<?php
session_start();
session_destroy();
header("Location:index.php");
echo "if your browser doesn't support auto redirect press "."<a href='index.php'>"."here</a>";