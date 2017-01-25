<?php
session_start();
$conn = odbc_connect ("YURA", "YURIY", "12345");



$idTeach = $_GET['id'];
if(isset($_POST['confirm'])){
    $q_1 = stripslashes($_POST['1']);
    $q_2 = stripslashes($_POST['2']);
    $q_3 = stripslashes($_POST['3']);
    $q_4 = stripslashes($_POST['4']);
    $q_5 = stripslashes($_POST['5']);
    $q_6 = stripslashes($_POST['6']);
    $today = date("Y-m-d H:i:s");
    //for ($i=1; $i<=6; $i++) {

// TRANSACTION START
odbc_autocommit($conn, FALSE);
odbc_exec($conn,"SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");

      $sql = "INSERT INTO results
      VALUES ($q_1,$idTeach,1, '$today');";
      odbc_exec($conn, $sql);
      $sql = "INSERT INTO results
      VALUES ($q_2,$idTeach,2, '$today');";
      odbc_exec($conn, $sql);
      $sql = "INSERT INTO results
      VALUES ($q_3,$idTeach,3, '$today');";
      odbc_exec($conn, $sql);
      $sql = "INSERT INTO results
      VALUES ($q_4,$idTeach,4, '$today');";
      odbc_exec($conn, $sql);
      $sql = "INSERT INTO results
      VALUES ($q_5,$idTeach,5, '$today');";
      odbc_exec($conn, $sql);
      $sql = "INSERT INTO results
      VALUES ($q_6,$idTeach,6, '$today');";
      odbc_exec($conn, $sql);
      
      echo "<script type=\"text/javascript\">
        alert('You are succsefully vote!');
        window.location.href = \"poll.php\";
      </script>"; 

      if (!odbc_error()){
          odbc_commit($conn);
          } 
      else {odbc_rollback($conn); }
          odbc_autocommit($conn, TRUE);      

}

?>

<html>
  
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RateIt</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    // Add the new slick-theme.css if you want the default styling
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <nav>
         <div class="container-fluid">
             <div class="subheader" style="position: fixed">
                 <div class="container">
                     <ul id="primary_menu">
                         <li><div  id="logo">
                             <span>R</span>
                             <span>a</span>
                             <span>t</span>
                             <span>e</span>
                             <span>I</span>
                             <span>t</span>
                         </div></li>

                         <li ><a href="index.php" >Main</a></li>


<?php

if (isset($_SESSION['mail'])){
  echo "<li ><a href=\"poll.php\" >Profile</a></li>";
  if($_SESSION['mail']=='yura@gmail.com'){
    echo "<li ><a href=\"admin.php\" >Admin</a></li>";
  }
}
?>                                        
                     </ul>

 
                     <ul id="right-links">

<?php

if (isset($_SESSION['mail'])){
  echo "<li><a>".$_SESSION['name']."</a></li>
  <li><a href=\"index.php?logout=true\"  >Log out</a></li> 
  </ul>";
} else{
  echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#login_user\">Log in</a></li>
                         <li><a href=\"#\" data-toggle=\"modal\" data-target=\"#reg_user\" >Sign up</a></li>
                         </ul>";
}
?> 



                 </div>
             </div>
         </div>
     </nav>
<!--Main Page-->

<br><br><br><br>
      <div class="container">
        <div class="row">
          <div class="col-md-12 ">
          
<?php

          
          $sql1 = "SELECT teacher_name FROM teachers
          where teacher_id = $idTeach ";
          $resultset1 = odbc_exec($conn, $sql1);
          $teacher_name = odbc_result($resultset1, 1);
          echo "<h1 class=\"text-center text-muted\">$teacher_name</h1>
           <br><br>";
$href ="vote.php?id=".$idTeach;
echo "
            
            <form class=\"form-horizontal\" method=\"POST\" action=\"$href\">";

          $sql = "SELECT q_text, q_id  FROM questions";
          $resultset = odbc_exec($conn, $sql);
$i=0;
          while (odbc_fetch_row($resultset)) {
$i++;
            $question = odbc_result($resultset, 1);
            
            //$href ="vote.php?id=".$idQuest;

            echo "
            
            

            <div class=\"form-group\">
              <h4 class=\" text-muted\">$question </h4>
           
               
              <div class=\"col-md-1 \">
              <select name = \"$i\" id=\"$i\" class=\"form-control\">
                <option>5</option>
                <option>4</option>
                <option>3</option>
                <option>2</option>
                <option>1</option>
              </select>
              </div>  
              </div>          
            ";

          }

          
?>
<br>


<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="confirm"  id="confirm" class="btn btn-primary">Confirm</button>
            </div>
          </div>
                </form>                   
</div></div></div>

<br>
<footer>
    <div class="container">
        <h5>♥ KPI one love ♥</h5>
    </div>
</footer>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->


</body>
</html>






