<?php
require_once("connection.php");
require_once("session.php");

function getStatus()
{
    session_start();
    return isset($_SESSION["id"]);
}

function getStatusAuth()
{
    if (session_status() == 0 || session_status() == 1) {
        session_start();
    }


    return isset($_SESSION["id"]);
}

function login()
{
    $db = dbConnect();
    $username = $db->escape_string($_POST["username"]);
    $password = $db->escape_string($_POST["password"]);
    $res = $db->query("SELECT id, username, roles FROM pengguna where username='$username' and password = '$password'");

    if ($res) {
        if ($res->num_rows == 1) {
            $data = $res->fetch_assoc();
            setSession($data["id"], $data["username"], $data["roles"]);
            return 0;
        } else {
            return 1;
        }
    } else {
        return 2;
    }
}
