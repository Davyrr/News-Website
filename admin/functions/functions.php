<?php 

function yoxlama($data = '')
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}


 ?>