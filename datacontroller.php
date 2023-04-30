<?php
session_start();
require "mail.php";
require "connection.php";
$email = "";
$name = "";
$id = "";
$errors = array();
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        $fetch_name = $fetch['name'];
        $fetch_id = $fetch['id'];
        if (password_verify($password, $fetch_pass)) {
            $status = $fetch['status'];
            if ($status == 'verified') {
                $_SESSION['name'] = $fetch_name;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $fetch_id;
                $check_event_detail = "SELECT * FROM event_detail WHERE id = '$fetch_id'";
                $res = mysqli_query($con, $check_event_detail);
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['event_reg'] = $fetch_id;
                } else {
                    $_SESSION['event_reg'] = 0;
                }

                header("location: index.php");
            } else {
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "Not registered !Register First";
    }
}


////////////////////////////////////////////////////// TO BE UPdated ////////////////////////////////////////////////////////////
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $fetch_name = $fetch_data['name'];
        $fetch_id = $fetch_data['id'];
        $fetch_TUNNEL = $fetch['DNS'];
        $fetch_DNS = $fetch['TUNNEL'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $fetch_name;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $fetch_id;
            header("location: index.php");
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}



if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (name, email, password, code, mobile, status)
                        values('$name', '$email', '$encpass', '$code', '$mobile','$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $mail->addAddress("$email", "$name"); //RECIVER
            $mail->isHTML(true);
            $mail->Subject = "Verification From Araz";
            $mail->Body = "Your verification code is $code";
            $mail->AltBody = "keep it safe";
            if ($mail->send()) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;

                //echo '<script type="text/javascript">window.location = "user-otp.php"</script>';
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}


if (isset($_POST['event_reg'])) {
    $eve_type = $_POST['eve_type'];
    $eve_detail = $_POST['eve_detail'];
    $invite_type = $_POST['invite_type'];
    $num_people = $_POST['num_people'];
    $ticket_table = strtok($_SESSION['name'], " ");
    $ad = $_SESSION['id'];
    $ticket_table .= $ad;
    $food = 0;
    $music = 0;
    $decor = 0;
    $seating = 0;
    $drinks = 0;
    if (@$_POST['serv_food'] == 1) {
        $food = 1;
    }
    if (@$_POST['serv_music'] == 1) {
        $music = 1;
    }
    if (@$_POST['serv_decor'] == 1) {
        $decor = 1;
    }
    if (@$_POST['serv_seating'] == 1) {
        $seating = 1;
    }
    if (@$_POST['serv_drinks'] == 1) {
        $drinks = 1;
    }
    $id = @$_SESSION['id'];
    $insert_data = "INSERT INTO event_detail (id, eve_type, eve_detail, invite_type, num_people,ticket_table,verif_status)
                        values('$id', '$eve_type', '$eve_detail', '$invite_type', '$num_people','$ticket_table' , 'Unverified')";
    $insert_data_booking = "INSERT INTO bookings (id, food, music, decor, seating, drinks)
                        values('$id', '$food', '$music', '$decor', '$seating' , '$drinks')";
    $data_check = mysqli_query($con, $insert_data);
    $data_check_booking = mysqli_query($con, $insert_data_booking);
    $em = @$_SESSION['email'];
    $nm = @$_SESSION['name'];
    if ($data_check) {
        $sen = "anisharaz919@gmail.com";
        $sen_name = "Anish Araz";
        $mail->addAddress("$sen", "$sen_name"); //RECIVER
        $mail->isHTML(true);
        $mail->Subject = "New Registration";
        $mail->Body = "New Registration for id $id";
        $mail->send();
        $_SESSION['notice'] = "Your event registration is done Waiting for Verification";
    } else {
        $mail->addAddress("$em", "$nm"); //RECIVER
        $mail->isHTML(true);
        $mail->Subject = "Booking Failed";
        $mail->Body = "Your Booking was failed for $eve_type Please retry";
        $mail->send();
        $_SESSION['notice'] = "Registration Failed";
    }
    $_SESSION['event_reg'] = $_SESSION['id'];
    header("location: event_reg.php");

}