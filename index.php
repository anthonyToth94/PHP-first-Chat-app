<?php 
session_start();
include('message.php');
include('users.php'); 
include('register.php');
include('login.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP CHAT ANTAL TOTH</title>
    <meta name="robots" content="follow,view" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Alata&display=swap"
      rel="stylesheet"
    />
  </head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <body>
    <main>
      <div class="background">
        <div style="background:black; padding:1rem">
        <?php
          include('database.php');
          $query = "SELECT u_name, u_login FROM users";
          $command = $pdo->query($query);
          $row = $command->fetchAll(PDO::FETCH_ASSOC);
          foreach($row as $index)
          {  ?>
            <h3> <?php echo $index['u_name'] ?> </h3>
            <h3 style="color:rgb(182, 31, 31);"> <?php if($index['u_login'] == 'offline') echo $index['u_login'] ?></h3>
            <h3 style="color:#43d77a;"> <?php if($index['u_login'] == 'online') echo $index['u_login'] ?></h3><a href="index.php?name=<?php echo $index['u_name'] ?>">SELECT</a><br><br><hr>
          <?php }
          $pdo = null;
        ?>
   
        </div>
        <div class="container0">
          <form class="box0" action="index.php" method="POST">
            <h1>Register</h1>
            <input type="text" placeholder="Username *" name="uname" value="<?php echo $uname; ?>"/>
            <input type="email" placeholder="Email *" name="uemail" value="<?php echo $uemail; ?>"/>
            <input type="password" placeholder="Password *" name="upass" value="<?php echo $upass; ?>"/>
            <input type="password" placeholder="Confirm password *" name="upass2" />
            <select name="ucountry">
              <option value="Hungary">Hungary</option>
              <option value="Germany">Germany</option>
              <option value="England">England</option>
              <option value="Belgium">Belgium</option>
              <option value="Switzerland">Switzerland</option>
            </select>
            <div id="inputs">
              <input type="radio" id="Male" name="ugender" value="male"/><label for="Male">Male</label>
              <input type="radio" id="Female" name="ugender" value="female"/><label for="Female">Female</label>
            </div>

            <span style="font-size:2rem; color:#f18973"><?php echo $regE['err1']; echo $regE['err2']; echo $regE['err3']; echo $registerSuccess; echo $regE['err4']; echo $regE['err5']; echo $regE['err6']; ?></span>
           
            <div class="bg">
              <input type="submit" name="register" value="Register">
              <!-- <a href=""><span class="submit">Submit</span></a> -->
            </div>
          </form>
        </div>

        <div class="containerMid">
          <form class="boxMid" action="index.php" method="POST">
            <h1>Login</h1>
            <input type="text" placeholder="Username" name="usernameL" value="<?php echo $usernameL ?>"/>
            <input type="password" placeholder="Password" name="passwordL" value="<?php echo $passwordL ?>" />
           <span style="margin-bottom:2rem; font-size:2rem; color:#f18973"><?php echo $regL['err1']; echo $regL['err2']; echo $regL['err3']; echo $loginSuccess; ?></span>
            <div class="bg">              
              <input type="submit" name="login" value="Login">
              <!-- <a href=""><span class="submit"> Login</span></a> -->
            </div>
          </form>
        </div>

        <div class="container">
          <div class="box">
            <div class="innerBox">
              <form action="index.php" method="POST">

                <h2 style="margin:0.8rem; color:green; display:inline-block;">
               <?php 
               if(isset($_SESSION['uname'])){ echo 'ONLINE';
               include('logout.php');?>
               </h2>
               <input type="submit" name="logout" id="logout" value="logout">
             <?php } ?>
              </form>

            </div>
            <div class="innerBox" id="displayText">
              <?php  
                  include('displayMessage.php');
                  include('writeMessage.php');
              ?>
            </div>

            <div class="innerBox">
              <h3 style="padding:1rem; color:rgb(20, 94, 72);display:inline-block;">
                <?php if(isset($_SESSION['uname'])){ echo $_SESSION['uname']; } ?>
              </h3><p style="display:inline-block;"> TO </p>
              <h3 style="display:inline-block; color:rgb(238, 66, 14)">
                <?php if(isset($_SESSION['rName'])){ echo $_SESSION['rName']; } ?>
              </h3>
              <form action="index.php" method="POST" class="message">
                <input type="text" placeholder="Write text.." id="textBox" name="textBox" value="<?php echo $msg; ?>" autocomplete="off"/>
                 <input type="submit" name="sendMessage" value="Enter" id="send">
              </form>
            </div>
          </div>
        </div>
      </div>
<?php 
require('footer.html');
?>