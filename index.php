<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Araz's</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="icon" href="images/logo/arazlogo-titlebar.png" type="image/icon type">
  <style>
    body {
      background-color: darkcyan;
    }

    .logo {
      padding-top: 10px;
      width: 100%;
      max-width: 50px;
      height: auto;
      border-radius: 50px;
    }

    .logo-araz {
      width: 100%;
      max-width: 80px;
      min-width: 50px;
      height: 10vh;
    }
  </style>
  <style>
    .item1 {
      grid-area: L;
    }

    .item2 {
      grid-area: T;
    }

    .item3 {
      grid-area: P;
    }

    .item4 {
      grid-area: I;
      padding: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .item5 {
      grid-area: X;
      padding: 30px;
    }

    .item6 {
      grid-area: Y;
    }



    .grid-container {
      display: grid;
      grid-template-areas:
        'L T T T P'
        'X X X X X'
        'I I I I I'
        'Y Y Y Y Y';
      row-gap: 1vh;
    }

    .grid-container>div {
      background-color: rgba(17, 138, 251, 0.491);
      text-align: center;

    }

    .ads1 {
      display: none;
    }

    .ads2 {
      display: none;
    }

    .ads3 {
      display: none;
    }

    @media(min-width:750px) {
      .video {
        padding: 2%;
        max-width: 50%;
      }

      .ads1 {
        display: block;
      }

      .ads2 {
        display: block;
      }

      .ads3 {
        display: block;
      }
    }

    .video {
      padding: 2%;
      width: 100%;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (session_status() === PHP_SESSION_ACTIVE) {
    $p_img_url = "images/img-used/user-logo.png";
    $loggin = @$_SESSION['name'];
    $p_logout = "logout.php";
    $geting_started = "event_reg.php";
    $geting_started_name = "DashBoard";
  }
  if (!isset($_SESSION['name'])) {
    $p_img_url = "images/img-used/user-logo.png";
    $loggin = "Login";
    $p_logout = "login.php";
    $geting_started = "signup-user.php";
    $geting_started_name = "Get Started";
  }

  ?>
  <div class="grid-container">
    <div class="item1"><img class="logo-araz" src="images/logo/arazlogo.png"></div>
    <div class="item2" style="font-family: 'Courier New', Courier, monospace;">
      <h2>D&D</h2>
    </div>
    <div class="item3">
      <a href="<?php echo $p_logout; ?>" style="font-family: 'Courier New', Courier, monospace;color:black;">
        <img class="logo" src="<?php echo $p_img_url; ?>"><br>
        <?php echo $loggin; ?><br>logout
      </a>
    </div>
    <div class="item5">
      <h2>We Bring Together</h2>
      <h4>Places And Emotions Are Made by Our Help<br><br><a class="btn btn-info"
          href="<?php echo $geting_started; ?>"><?php echo $geting_started_name; ?></a>

      </h4>
    </div>
    <div class="item4">
      <div class="video">Embeded Viceo Code<br></div>

    </div>
    <div class="item6">
      <h4>We May Leave But Our Work Stay</h4><br>

    </div>
  </div>



</body>

</html>