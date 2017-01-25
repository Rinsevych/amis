<?php
$conn = odbc_connect ("YURA", "YURIY", "12345");
if (isset($_POST['login'])) {
    $email = stripslashes($_POST['Email']);
    $password = stripslashes($_POST['Password']);
    $sql="SELECT count(res_email) from Respondents
    where rtrim(res_email) ='$email' and rtrim(res_pasword)='$password'";
    $resultset = odbc_exec($conn,$sql); 
    $emailExist = odbc_result($resultset, 1);
    if ($emailExist==1){ 

      echo "<script type="text/javascript">
        alert('Hello!');
        window.location.href = "poll.php";

      </script>";


    }
    else{
      echo "<script type="text/javascript">
        alert('Sorry! User does not exist.');
        

      </script>";
  

}
}

?>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Authorization</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="common.css" rel="stylesheet">
  </head>

  <body>
  <div class="cover">
   <div class="background-image-fixed cover-image" style="background-image : url('images/113.jpg')"></div>

      <div class = "container">

       <div class = "col-sm-3"></div>

        <div class = "col-sm-6">
          <h1 class = "header"> Registration form </h1>
            <form class="form-horizontal" method="POST" action="registration.php">
            <div class="form-group">
              
              <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                <input name = "Email" type="email" class="form-control" id="inputEmail" required="" placeholder="example@gmail.com">
                </div>
              </div>
          <div class="form-group">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input name = "Password" type="password" class="form-control" id="inputPassword" required="" placeholder="Password">
            </div>
          </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="login"  id="submit" class="btn btn-success">Log in</button>
            </div>
          </div>
          </form>
        </div>
        </div>
        <div class = "col-sm-3"></div>
      </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="bootstrap/js/bootstrap.min.js"></script>
          </body></html>