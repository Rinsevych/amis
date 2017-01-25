<?php
$conn = odbc_connect ("YURA", "YURIY", "12345");
session_start();
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
<div class="container-fluid" id="page" style="padding: 0">
    <div class="container-fluid sms" >
        <div class="row" id = "prof_info">
            <div class="col-sm-4">
                <img src="../images/user_male.png" alt="">
                
            </div>

<?php
echo " <div class=\"col-sm-5\" style=\"text-align: left\">
                <h3>".$_SESSION['name']."</h3>
                <h4><span class=\"glyphicon glyphicon-envelope\"></span> ".$_SESSION['mail']."</h4>
                <h4><span class=\"glyphicon glyphicon-list-alt\"></span> ".$_SESSION['faculty']."</h4>

            </div>";
?>
  
          </div>
    </div>
    <div class="container" style="text-align: center">
        <h1>Choose the teacher</h1>
    </div>
<?php
          $sql = "SELECT teacher_name, teacher_id  FROM teachers";
          $resultset = odbc_exec($conn, $sql);
echo "
            <div class=\" container teachers_slider\">";    
          while (odbc_fetch_row($resultset)) {

            $teacher = odbc_result($resultset, 1);
            $id = odbc_result($resultset, 2);

          $sql1 = "SELECT mrk FROM average where tid=".$id;
          $resultset1 = odbc_exec($conn, $sql1);
 $mark = (odbc_result($resultset1, 1));

            $href ="vote.php?id=".$id;
            echo "
            
<div class=\"item_body\">
            <div class=\"teacher_logo_min\">
                <img src=\"../images/user_male.png\"/>
            </div>
                <h3> $teacher </h3>
                <h2>".$mark."</h2>
                <a  class=\"btn btn-primary\" href=\"$href\">Vote</a>
        </div>";

          }

echo " </div>";
          
?>
</div>
<footer>
    <div class="container">
        <h5>♥ KPI one love ♥</h5>
    </div>
</footer>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(() => {
        $('.teachers_slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots:true,
            arrows:true,

        });
        }
    );
</script>
</body>
</html>






