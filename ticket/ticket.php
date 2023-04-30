<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    @$_SESSION['notice'] = "";
    $name = $_GET['name'];
    $num = $_GET['num'];
    $id = $_GET['id'];
    $id_str = strval($id);
    $ticket_table = strtok($name, " ");
    $ticket_table .= $id_str;
    $con = mysqli_connect('localhost', 'id20679534_tickets', 'Edt6oQuhyq&9_(~d', 'id20679534_ticket');
    $check = "SELECT * FROM anish4";
    $res = mysqli_query($con, $check);
    mysqli_num_rows($res);
    $fetch = mysqli_fetch_assoc($res);
    if (isset($_POST['ticket'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $insert_data = "INSERT INTO $id (tick_name, tick_contact)
                        values('$name', '$email')";
        $data_check = mysqli_query($con, $insert_data);
        $insert_data = "SELECT * FROM $ticket_table WHERE tick_contact = '$email' ";
        $data_check = mysqli_query($con, $insert_data);
        $fetch = mysqli_fetch_assoc($data_check);
        $tick_id = $fetch['tick_num'];
        require "mail.php";
        $mail->addAddress("$email", "$name"); //RECIVER
        $mail->isHTML(true);
        $mail->Subject = "Tick Reserved";
        $mail->Body = "Your Ticket is ready. Ticket code : $tick_id";
        if ($mail->send()) {
            $_SESSION['notice'] = "We've sent a verification code to your email - $email";
        }

    }
    if (mysqli_num_rows($res) > $num) { ?>

        <div>
            <?php echo $_SESSION['notice']; ?>
            The Event limit is reached.
            </diu>


        <?php } else { ?>
            <form method="post" action="event_reg.php">
                <input type="text" name="name" required /> Enter Name: <br>
                <input type="email" name="email" required /> Enter Email:<br>
                <input type="submit" value="submit" name="ticket" />
            <?php } ?>





</body>

</html>