<?php
$conn = odbc_connect ("YURA", "YURIY", "12345");
?>
 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
    rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css"
    rel="stylesheet" type="text/css">
  </head>
  
  <body>
  
    <div class="cover">
    
      <div class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>Poll's family</span></a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active">
                <a href="index.php">Results</a>
              </li>
              <li>
                <a href="poll.php">Poll</a>
              </li>
              <li>
                <a href="login.php">Entrance</a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="cover-image"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1>Welcome to the poll's family</h1>
            <p>Hello, if you want rate your teacher, please make registration!</p>
            <br>
            <br>
            <a href="registration.php" class="btn btn-primary btn-lg active" role="button">Registration</a>
                       
          </div>
        </div>
      </div>
    </div>
  </body>

</html>