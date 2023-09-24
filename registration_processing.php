

<?php
require_once 'server.php';

if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['birthday']) && isset($_POST['nationality']) && isset($_POST['fonction']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-retype'])) {

    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $nationality = htmlspecialchars($_POST['nationality']);
    $fonction = htmlspecialchars($_POST['fonction']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwor_retype = htmlspecialchars($_POST['password-retype']);


    /* check if that user exist in our database */
    $check_admin = $dataBase->prepare("SELECT firstName,lastName,email FROM administrator WHERE email=?");
    $check_admin->execute(array($email));
    $data_admin = $check_admin->fetch();
    $row_admin = $check_admin->rowCount();

    //CHEK STAFF
    $check_staff = $dataBase->prepare("SELECT firstName,lastName,email FROM staff WHERE email=?");
    $check_staff->execute(array($email));
    $data_staff = $check_staff->fetch();
    $row_staff = $check_staff->rowCount();

    if ($row_admin == 0 || $row_staff == 0) {
        if (strlen($firstName) <= 100 && strlen($lastName) <= 100) { //  length verification of first and LastName
            if (strlen($email) <= 100) { //length verification of email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($password == $passwor_retype) {
                        $password = md5($password);
                        $ip_adress = $_SERVER['REMOTE_ADDR'];
                        // INSERT DATA INTO DATABASE
                        $insert_into_DB = $dataBase->prepare("INSERT INTO staff (firstName,lastName,email,password,birthday,nationality,fonction) VALUES(:firstName,:lastName,:email,:password,:birthday,:nationality,:fonction");
                        $insert_into_DB->execute(array(
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'email' => $email,
                            'password' => $password,
                            'birthday' => $birthday,
                            'nationality' => $nationality,
                            'fonction' => $fonction
                        ));

                        header('Location:registration.php?reg_error=success');
                    } else header('Location:registration.php?reg_error=password_retype');
                } else header('Location:registration.php?reg_error=invalid_email');
            } else header('Location:registration.php?reg_error=email_length');
        } else header('Location:registration.php?reg_error=name_length');
    } else header('Location:registration.php?reg_error=already');
} else {
}

?>