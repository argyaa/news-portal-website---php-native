<?php
function dbConnect()
{
    $connect = new mysqli("localhost", "root", "", "news_atol");
    return $connect;
}
