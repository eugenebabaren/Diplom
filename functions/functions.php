<?php

function clearString($cl_str)
{
    include("include/db_connect.php");
    $cl_str = strip_tags($cl_str);
    $cl_str = mysqli_real_escape_string($link, $cl_str);
    $cl_str = trim($cl_str);

    return $cl_str;
}
