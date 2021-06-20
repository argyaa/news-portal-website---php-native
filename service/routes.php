<?php
require_once("service/functions.php");
$req = $_SERVER['REQUEST_URI'];
$hiddenNav = false;
$page = "";
$id = isset($_GET['id']) ? $_GET['id'] : '';
$keyword = isset($_GET['q']) ? $_GET['q'] : '';

if (getStatus()) {
    if ($_SESSION["roles"] == "admin") {
        switch ($req) {
            case '/manage/users':
                $page = "pages/user/users.php";
                break;
            case '/manage/add-user':
                $page = "pages/user/add_user.php";
                break;
            case '/manage/edit-user':
                $page = "pages/user/edit_user.php";
                break;
            case '/manage/del-user':
                $page = "pages/user/delete_user.php";
                break;
            case '/manage/category':
                $page = "pages/article/category/category.php";
                break;
            case '/manage/edit-category':
                $page = "pages/article/category/edit_category.php";
                break;
        }
    }
    switch ($req) {
        case '/manage/articles':
            $page = "pages/article/article.php";
            break;
        case '/manage/edit-article':
            $page = "pages/article/edit_article.php";
            break;
        case '/details/articles?id=' . $id:
            $page = "pages/article/detail_article.php";
            break;
        case '/manage/del-article':
            $page = "pages/article/delete_article.php";
            break;
        case '/manage/add-article':
            $page = "pages/article/add_article.php";
            break;
        case '/profile/users':
            $page = "pages/profile/profile.php";
            break;
        case '/logout':
            endSession();
            header("Location: /");
            break;
        case '/dashboard':
            $page = "pages/dashboard.php";
            break;
    }
}

switch ($req) {
    case '/result?q=' . $keyword:
        $page = "pages/result_search.php";
        break;
    case '/details/articles?id=' . $id:
        $page = "pages/article/detail_article.php";
        break;
    case '/':
        $page = "pages/home.php";
        break;
    case '/login':
        $hiddenNav = true;
        $page = "pages/login.php";
        break;
    case '/test':
        $hiddenNav = true;
        // mysqli_query($db, "SELECT roles FROM pengguna where id='1'");
        $page = "pages/404.php";
        break;
}

if ($page == "") {
    $page = "pages/404.php";
}

function getHiddenNav()
{
    global $hiddenNav;
    return $hiddenNav;
}

function getPage()
{
    global $page;
    return $page;
}
