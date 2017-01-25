<?php


$conn = odbc_connect ("YURA", "YURIY", "12345");
session_start();
if (isset($_GET['logout'])) {
    session_unset();
  }
?>
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate it</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">
    
</head>
  
 <body>
 <!--Modals-->
     <div class="modal fade " id="reg_user"  tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content ">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                 </div>
                 <div class="modal-body">
                     <form class="form-horizontal" method="POST" action="registration.php">
                         <div class="form-group">
                             <label for="inputName" class="col-sm-2 control-label">Name</label>
                             <div class="col-sm-10">
                                 <input name= "Name" type="text" class="form-control" id="inputName" required="" placeholder="Name">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="inputFaculty" class="col-sm-2 control-label">Faculty</label>
                             <div class="col-sm-10">
                                 <input name = "Faculty" type="text" class="form-control" id="inputFaculty" required="" placeholder="Faculty">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                             <div class="col-sm-10">
                                 <input name = "Email" type="email" class="form-control" id="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" placeholder="example@gmail.com">
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                             <div class="col-sm-10">
                                 <input name = "Password" type="password" class="form-control" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="" placeholder="Password">
                             </div>
                         </div>
                         <div class="form-group">
                             <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" name="submit"  id="submit" class="btn btn-success">Sign up</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade " id="login_user"  tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content ">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Log In</h4>
                 </div>
                 <div class="modal-body">
                     <form class="form-horizontal" method="POST" action="login.php">
                             <div class="form-group">
                                 <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                 <div class="col-sm-10">
                                     <input name = "Email" type="email" class="form-control" id="l_inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="" placeholder="example@gmail.com">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                 <div class="col-sm-10">
                                     <input name = "Password" type="password" class="form-control" id="l_inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="" placeholder="Password">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="col-sm-offset-2 col-sm-10">
                                     <button type="submit" name="login"  id="login" class="btn btn-success">Log in</button>
                                 </div>
                             </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 <!--Menu-->
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
         <div class="welcome " style="margin-top: 50px">
             <div class="container-fluid sms" >
                 <p  id="title_1">Welcome to RateIt! </p>
                 <p id="title_2">If you want rate your teacher, please make registration!</p>
                 <br>
                 <p id="title_3"> ла ла ла </p>
             </div>
         </div>
         <div class="container">
 <!--
             <div class="teacher_body">
                 <div class="teacher_logo col-sm-3">
                     <img src="../images/user_male.png"/>
                 </div>
                 <div class="teacher_info col-sm-9">
                     <h3> Хуйленко Педрило Обригайлович </h3>
                     <h5>ФПР(Факультет прикладного рукоблудства)</h5>
                     <div class="teacher_rate">

                   
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                     </div>
                 </div>
             </div>
             <div class="teacher_body">
                 <div class="teacher_logo col-sm-3">
                     <img src="../images/user_male.png"/>
                 </div>
                 <div class="teacher_info col-sm-9">
                     <h3> Хуйленко Педрило Обригайлович </h3>
                     <h5>ФПР(Факультет прикладного рукоблудства)</h5>
                     <div class="teacher_rate">
                         
                         <
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                         <span class="glyphicon glyphicon-star"></span>
                     </div>
                 </div>
             </div>
-->

         </div>
     </div>
     <br><br><br>
 <footer>
     <div class="container">
         <h5>♥ KPI one love ♥</h5>
     </div>
 </footer>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="jquery/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="bootstrap/js/bootstrap.min.js"></script>
 </body>

</html>