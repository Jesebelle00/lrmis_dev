<?php 
    $db_server = '153.92.5.246'; 
    $db_name = 'lrmis'; 
    $db_user = 'lrmisuser'; 
    $db_password = 'Killerbeat83!';

    $link = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($link, 'utf8');

?>
