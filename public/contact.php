<?php
  // require_once(__DIR__ . '/../private/php/contact.php');


?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dsign - Minimal portfolio Bootstrap template</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<!-- header section -->
<section class="banner" role="banner"> 
  <!--header navigation -->
  <header id="header">
    <div class="header-content clearfix"> <a class="logo" href="index.php"><img src="images/logo.png" alt=""></a>
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
          <li><a href="about.html">About me</a></li>
          <li><a href="contact.html">Contact</a></li> 
        </ul>
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
  <!--header navigation --> 
</section>
<!-- header section --> 
<!-- title section -->
<section id="banner" class="banner no-padding">
  <div class="container-fluid">
    <div class="row no-gutter">
      <ul class="slides">
        <li>
          <div class="col-md-12">
            <blockquote>
              <p>Contact</p>
            </blockquote>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<!-- title section --> 
<!-- contact section -->
<section id="teams" class="section teams">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-5">
        <div class="bio">
          <h4>追加して欲しい食材、機能など<br>
            ご要望はこちらから</h4>
        </div>
      </div>
      <div class="col-md-7 col-sm-7 conForm">
        <div class="contact">
          <div id="message"></div>
          <form method="post" action="php/contact.php" name="cform" id="cform">     
            <input name="name" id="name" type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Your name..." >
            <input name="email" id="email" type="email" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Email Address..." >
            <textarea name="comments" id="comments" cols="" rows="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Project Details..."></textarea>
            <input type="submit" id="submit" name="send" class="submitBnt" value="Send">
            <div id="simple-msg"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- contact section --> 
<!-- footer -->
<footer class="section footer">
  <div class="footer-bottom">
    <div class="container">
      <div class="col-md-12">
        <p>© 2021 T.Fukuju. All Rights Reserved<br>
      </div>
    </div>
  </div>
</footer>
<!-- footer --> 
<!-- JS FILES --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flexslider-min.js"></script> 
<script src="js/jquery.fancybox.pack.js"></script> 
<script src="js/jquery.waypoints.min.js"></script> 
<script src="js/retina.min.js"></script> 
<script src="js/modernizr.js"></script> 
<script src="js/jquery.contact.js"></script> 
<script src="js/main.js"></script>
</body>
</html>