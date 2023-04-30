<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='css/login.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <div align="center"><img src="images/logo/arazlogo.png" class="img"></div>
    <form method="post" action="datacontroller.php">
        <div class="login-block">
            <h1>Login</h1>
            <input type="email" placeholder="Username/email" required id="username" name="email" />
            <input type="password" placeholder="Password" required id="password" name="password" />
            <input type="submit" value="Login" name="login" class="submit" /><br>
            <div align="center"><a href="signup-user.php" class="submit">SignUp</a></div>

            <?php
            include "datacontroller.php";
            if (count($errors) > 0) {
                ?>
                <div class="error">
                    <?php
                    foreach ($errors as $showerror) {
                        echo $showerror;
                    }
                    ?>
                </div>
                <?php
            }
            ?>


        </div>

    </form>

</body>

</html>