<?php

session_start();
require_once 'server.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    /* Check if this user exist in our database and it an administrator */
    $check_admin = $dataBase->prepare("SELECT firstName,lastName,email FROM administrator WHERE email=?");
    $check_admin->execute(array($email));
    $data_admin = $check_admin->fetch();
    $row_admin = $check_admin->rowCount();

    /*/* Check if this user exist in our database and it an staff */
    $check_staff = $dataBase->prepare("SELECT firstName,lastName,email FROM staff WHERE email=?");
    $check_staff->execute(array($email));
    $data_staff = $check_staff->fetch();
    $row_staff = $check_staff->rowCount();

    if ($row_admin == 1 || $row_staff == 1) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $password = md5($password); // or hash('sha256',$password);
            if ($data_admin['password'] === $password) {
                //open admin session
                $_SESSION['admin'] = $data_admin['lastName'];
                header('Location:event.php');
            } else if ($data_staff['password'] === $password) {
                //open staff session
                $_SESSION['staff'] = $$data_staff['lastName'];
                header('Location:event.php');
            } else header('Location:app.php?login_error=password');
        } else header('Location:app.php?login_error=email');
    } else header('Location:app.php?login_error=exist');
} else header('Location:app.php');
