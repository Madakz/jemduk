<?php
  session_start();
?>
<?php include("includes/con.php"); 
  if (empty($_SESSION)) {
    header("location:admin/login.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mete Select</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language="JavaScript" src="js/jquery.js"></script>
    <script language="JavaScript" src="functionsjq.js"></script>
    <script type="text/javascript" src="js/manualwrite.js"></script>
    <!-- Bootstrap -->
    <link href="cssm/bootstrap.css" rel="stylesheet">
    
    <!--Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Belgrano|Courgette&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    
    <!--Bootshape-->
    <link href="cssm/bootshape.css" rel="stylesheet">

    <link href="admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>
  <body>
    <!-- Navigation bar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" id="header1">METE MATERIAL SELECTOR</a>
        </div>
        <nav role="navigation" class="collapse navbar-collapse navbar-right">
          <ul class="navbar-nav nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">property <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="mpwmd.php">Material Property with Material Designation</a></li>
                <li><a href="mpwmn.php">Material Property with Material Number</a></li>
                <li><a href="mpwmw.php">Material Property with Manual Writing</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle"><b style="float:right; color:#000; "><i class="fa fa-user"></i><?php echo "Welcome" . " " . $_SESSION['uzaname'];?></b><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><b style="color:#000; "><i class="fa fa-user"></i><?php echo "Welcome" . " " . $_SESSION['uzaname'];?></b></a></li>
                <li><a href="admin/logout.php">Log-out</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div><!-- End Navigation bar -->

    <!-- Slide gallery -->
    <div class="jumbotron">
      <div class="container">
        <div class="col-md-12" id="headtop">
        	<h3>MATERIAL PROPERTIES WITH MANUAL WRITING</h3>
          <hr>
        </div>
        <div class="col-md-12" id="selector">
          <form id="property" name="prop" action="" method="POST">
            <div class="col-md-12" id="top">
              <div class="col-md-4" id="padd">
                Standard Name:
              </div>
              <div class="col-md-8">
                <select name="standard" id="standard">
                  <option value="">Please select:</option>
                </select>
              </div>
            </div>
            <div class="col-md-12" id="top">
              <div class="col-md-4">
                Classification Group:
              </div>
              <div class="col-md-8">
                <select name="classG" id="classG" disabled="disabled">
                  <option value="">Please select:</option>
                </select>
              </div>
            </div>
            <div class="col-md-12" id="top">
              <div class="col-md-4">
                  Material Name:
              </div>
              <div class="col-md-8">
                <input type="text" id="search-box" name="designname" placeholder="Material Name" class="form-control" autocomplete="off"/>
              <div id="suggesstion-box"></div>

              <input type="hidden" name="number" value="">
              <input type="hidden" name="design" value="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-4"></div>
              <div class="col-md-8">
                <input type="submit" name="general" value="General Properties" class="btn btn-primary" class="form-control" onclick="prop.action='generalprop.php'; return true;"><br>
                <input type="submit" name="chemical" value="Chemical Properties" class="btn btn-primary" onclick="prop.action='chemicalprop.php'; return true;"><br>
                <input type="submit" name="mechanical" value="Mechanical Properties" class="btn btn-primary" class="form-control" onclick="prop.action='mechanicalprop.php'; return true;"><br>
                <input type="submit" name="physical" value="Physical Properties" class="btn btn-primary" onclick="prop.action='physicalprop.php'; return true;"><br>
                <input type="submit" name="thermal" value="Thermal Properties" class="btn btn-primary" onclick="prop.action='thermalprop.php'; return true;"><br>
                <input type="submit" name="heattreat" value="Heat Treatment" class="btn btn-primary" onclick="prop.action='heattreatment.php'; return true;"><br><br>
                <a href="./index2.php"><button class="btn btn-warning">Back to Main Menu</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Thumbnails -->
    <div class="container thumbs">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          
          <div class="caption">
            <h3 class="">Aluminium Works</h3>
            
          </div>
          <img src="images/slide1.jpg">
          <p>We give you the Aluminium properties of your desired Aluminium</p>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <div class="caption">
            <h3 class="">Cars</h3>
          </div>
          <img src="images/slide5.jpg">
          <p>We give you the steel properties that fit your intended car design</p>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <div class="caption">
            <h3 class="">Steel Works</h3>
          </div>
          <img src="images/slide6.jpg">
          <p>In construction cases, properties about the appropriate Steel to be used is found here.</p>
        </div>
      </div>
    </div><!-- End Thumbnails -->
    <!-- Content -->
    <div class="container">
    </div><!-- End Content -->
    <!-- Footer -->
    <div class="footer text-center">
        <p>&copy; 2016 Mete Group. All Rights Reserved. Proudly created by <a href="http://nhubnigeria.com">nHub Nigeria</a></p>
    </div><!-- End Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootshape.js"></script>
  </body>
</html>
