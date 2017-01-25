<?php
$conn = odbc_connect ("YURA", "YURIY", "12345");
if (isset($_POST['submit'])) {
    $name = stripslashes($_POST['Name']);
    $faculty = stripslashes($_POST['Faculty']);
    $email = stripslashes($_POST['Email']);
    $password = md5(stripslashes($_POST['Password']));

    // TRANSACTION START
odbc_autocommit($conn, FALSE);
odbc_exec($conn,"SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");

    $sql="SELECT count(res_email) from Respondents
    where rtrim(res_email) ='$email'";
    $resultset = odbc_exec($conn,$sql); 
    $emailExist = odbc_result($resultset, 1);
    if ($emailExist==1){ 
      echo "Sorry! This email or password is already used";}
    else{
      $sql="
    INSERT INTO Respondents 
    VALUES('$name', '$email', '$faculty', '$password')";
  
    odbc_exec($conn,$sql);
          if (!odbc_error()){
            odbc_commit($conn);
            
            echo "<script type=\"text/javascript\">
        alert('You are succsefully registered!');
        window.location.href = \"index.php\";
      </script>"; 
            }
          else{
            {odbc_rollback($conn); }
            odbc_autocommit($conn, TRUE);
            
            echo "<script type=\"text/javascript\">
        alert('Sorry! Try again.');

        

      </script>";
  
          }
}
}

?>
