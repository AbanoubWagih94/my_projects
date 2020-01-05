<?php

    $past = time()-3600;
    session_start();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
    header("Location: index.php");

    echo "if your browser doesn't support auto redirect press "."<a href='index.php'>"."here</a>";