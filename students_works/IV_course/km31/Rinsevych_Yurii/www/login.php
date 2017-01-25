<?php
$conn = odbc_connect ("YURA", "YURIY", "12345");
if (isset($_POST['login'])) {
    $email = stripslashes($_POST['Email']);
    $password = md5(stripslashes($_POST['Password']));
    $sql="SELECT res_name, faculty  from Respondents
    where rtrim(res_email) ='$email' and rtrim(res_pasword)='$password'";
    $resultset = odbc_exec($conn,$sql); 
    $name = odbc_result($resultset, 1);
    $f = odbc_result($resultset, 2);
    if ($name != ''){ 
      echo "<script type=\"text/javascript\">
        window.location.href = \"index.php\";
        alert('Hello!');
      </script>";
      session_start();
      $_SESSION['mail'] = $email;
      $_SESSION['name'] = $name;
      $_SESSION['faculty'] = $f;


    }
    else{
      echo "<script type=\"text/javascript\">
        alert('Sorry! User does not exist.');
        window.location.href = \"index.php\";
        

      </script>";
  

}
}

?>
