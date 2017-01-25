<?php
session_start();
$conn = odbc_connect ("YURA", "YURIY", "12345");

if (isset($_GET['del'])){
  $idDel=$_GET['del'];
  $sqlDel = "delete Questions where q_id=".$idDel;
  odbc_exec($conn, $sqlDel);
  if (!odbc_error()){
          
          echo "<script type=\"text/javascript\">
        alert('You are succsefully delete question!');
        window.location.href = \"admin.php\";
      </script>"; 
          }
}


if (isset($_POST['submitSave'])){
  $id=$_GET['save'];
  $inputId = "q".$id;
  $text = $_POST["$inputId"];
$sql = "select count(*) from Questions where q_text='".$text."'";
          $resultset = odbc_exec($conn, $sql);
 $exist = (odbc_result($resultset, 1));
 if ($exist==1){
  echo "<script type=\"text/javascript\">
        alert('question has been already published');
        
      </script>"; 
 } else {

  $sqlSave = "update Questions  set q_text='".$text."' where q_id=".$id;
  odbc_exec($conn, $sqlSave);
  if (!odbc_error()){
          
          echo "<script type=\"text/javascript\">
        alert('quest has been changed');
        window.location.href = \"admin.php\";
      </script>"; 
          }

 }

}



if (isset($_POST['submitNew'])){

  $text = $_POST['inputNew'];

// TRANSACTION START
odbc_autocommit($conn, FALSE);
odbc_exec($conn,"SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");


$sql = "select count(*) from Questions where q_text='".$text."'";
$resultset = odbc_exec($conn, $sql);
$exist = (odbc_result($resultset, 1));
 if ($exist==1){
  echo "<script type=\"text/javascript\">
        alert('question has been already published');        
      </script>"; 
 } else {


$sqlMax = "select max(q_id) from Questions";
          $resultsetMax = odbc_exec($conn, $sqlMax);
 $idMax = (odbc_result($resultsetMax, 1));
$idMax+=1;
  $sqlSave = "insert into Questions  values('$text',$idMax)";
  odbc_exec($conn, $sqlSave);
  if (!odbc_error()){
          odbc_commit($conn);
          
          echo "<script type=\"text/javascript\">
        alert('quest has been saved');
        window.location.href = \"admin.php\";
      </script>"; 
          }
           else {odbc_rollback($conn); }
          odbc_autocommit($conn, TRUE);

 }

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
          <div class="col-md-6 ">
          
<?php
          $sql = "SELECT rtrim(q_text), q_id  FROM questions";
          $resultset = odbc_exec($conn, $sql);
$i=0;
          while (odbc_fetch_row($resultset)) {
$i++;
            $question = odbc_result($resultset, 1);
$id = intval(odbc_result($resultset, 2));

            echo "
            
            <form class=\"form-horizontal\" method=\"POST\" action=\"admin.php?save=".$id."\">

            <div class=\"form-group\">
<div class=\"col-sm-10\">
<br>
                                     <input name = \"q".$id."\"  class=\"form-control\" id=\"q".$id."\" required=\"\" minlength=\"1\" maxlength=\"100\">
                                     <script type='text/javascript'>document.getElementById('q".$id."').value = '$question';</script>
                                    
                                    <button type=\"submit\" name=\"submitSave\"  id=\"submitSave\" class=\"btn btn-success\">save</button>
                                    <a id=\"delButton".$i."\" href=\"admin.php?del=".$id."\"> delete </a>



                                 </div>
              </div> 
              </form>         
            ";

          }
          
          if ($i==6){
            for ($i = 1; $i <= 6; $i++) {
                  echo "<script type='text/javascript'>document.getElementById(\"delButton".$i."\").href = \"\";</script>";}
              }
              
                
      
          

          
?>
<form class="form-horizontal" method="POST" action="admin.php">
<div class="form-group">
<div class="col-sm-10">
<input name = "inputNew"  class="form-control" id="inputNew" required="" minlength="1" maxlength="100">
      </div>
      </div>
      <button type="submit" name="submitNew"  id="submitSave" class="btn btn-primary">new</button>
      </form>

<br>


                  
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
