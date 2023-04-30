<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event_reg.css">
    <title>Booking</title>
</head>
<style>
    /* body {
        background-image: url("bg.jpg");

    } */
</style>

<body>
    <form method="post" action="event_reg.php">
        <?php
        include "datacontroller.php"; ?>
        <div style="color:red;">
            <?php echo @$_SESSION['notice']; ?>
        </div>
        <h3>Enter the Detail About Booking </h3> <br>

        <div class="bf">
            Select Best event fit <br><br>
        </div>
        <div class="type">
            <input type="radio" name="eve_type" value="wedding">Wedding<br>
            <input type="radio" name="eve_type" value="birthday">Birthday<br>
            <input type="radio" name="eve_type">Other : <input type="text" name="other_eve_type" /> <br> <br><br>
        </div>

        <div class="bf"> Describe the detail of event</div>
        <input type="text" name="eve_detail" class="form-detail" /><br><br>

        <div class="bf"> Select Invite Type </div>
        <input type="radio" name="invite_type" value="link">Link(for limited number)<br>
        <input type="radio" name="invite_type" value="ticket">Ticket(For limited number)<br><br>


        <div class="bf"> Enter Number of person Limit </div>
        <input type="number" name="num_people" /><br><br>

        <div class="bf"> Select the Services Requested </div>
        <input type="checkbox" name="serv_food" value=1 />Food <br>
        <input type="checkbox" name="serv_music" value=1 />Music <br>
        <input type="checkbox" name="serv_decor" value=1 />Decoration <br>
        <input type="checkbox" name="serv_seating" value=1 />Seating Arrangement<Br>
        <input type="checkbox" name="drinks" value="1" />Drinks <br>

        <br><input type="submit" value="submit" name="event_reg" class="sub" /><br>
        <div align="center"><a href="signup-user.php" class="sub">SignUp</a></div>
        <?php
        if (@$_SESSION['event_reg'] != 0) {
            $id = $_SESSION['id'];
            $check_event_reg = "SELECT * FROM event_detail WHERE id = '$id'";
            $res = mysqli_query($con, $check_event_reg);
            $fetch = mysqli_fetch_assoc($res);
            $fetch_eve_type = @$fetch['eve_type'];
            $fetch_verif_status = @$fetch['verif_status'];
        }
        ?>
    </form>
    <hr>
    <div class="your-booking">
        Your bookings <br><br>
    </div>

    <div>
        <?php if (@$_SESSION['event_reg'] != 0) { ?>
            <table class="booking">
                <tr>
                    <th>Event Type</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>

                        <?php echo $fetch_eve_type ?>
                    </td>
                    <td>
                        <?php echo $fetch_verif_status ?>
                    </td>
                <tr>

            </table>
        <?php } else { ?>
            <div class="not-reg"> No Registration yet!! </div>
        <?php } ?>

    </div>
</body>

</html>