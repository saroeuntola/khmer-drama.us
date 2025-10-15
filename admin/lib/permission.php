<?php

include("auth.php");

function OnlyRolesAdmin() {

    $auth = new Auth();
    
    if ($auth->is_logged_in()) {
        if ($_SESSION['role_id'] != 1) {
            header("Location: /");
            exit;
        }
    } else {
        header("Location: /login");
        exit;
    }
}

function onlyPosterAndAdmincanAccess()
{
    $auth = new Auth();
    if ($auth->is_logged_in()) {
        if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 3) {
            header("Location: /");
            exit;
        }
    } else {
        header("Location: /");
        exit;
    }
}

?>
