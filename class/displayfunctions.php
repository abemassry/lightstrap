<?php

function displayContent($page) {
    if ($page == 'about') {
        $page_content = displayAbout();
    } elseif ($page == 'contact') {
        $page_content = displayContact();
    } elseif ($page == 'signup') {
        $page_content = displaySignUp();
    } elseif ($page == 'signin') {
        $page_content = displaySignIn();
    } elseif ($page == 'main_logged') {
        $name = $_SESSION['user_logged'];
        $page_content = displayMainLogged($name);
    } 
    
    $display = <<< EOF
        <div class="container">
        $page_content

    <hr class="span12">
EOF;
return $display;
}

function displayMainLogged($user) {
    $page = getLoggedPage();
    $page_content = 'Some Content relevant to a logged in user';
    $display = <<< EOF
        $page_content
    <div class="span12">&nbsp;</div>
EOF;
return $display;
}

function displayHTMLHead() {
    $html_dir = getHTMLDir();
    $display = <<< EOF
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>lightstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="lightstrap">
    <meta name="author" content="authorname">

    <!-- Le styles -->
    <link href="$html_dir/assets/css/bootstrap.css" rel="stylesheet">
    <link href="$html_dir/assets/css/datepicker.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="$html_dir/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="$html_dir/assets/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="$html_dir/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="$html_dir/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="$html_dir/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="$html_dir/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
EOF;
return $display;
}

function displayMasthead() {
    $html_dir = getHTMLDir();
    $page = getPage();
    $active = 'class="active"';
    if ($page == '') {
        $home_active = $active;
    } elseif ($page == 'about') {
        $about_active = $active;
    } elseif ($page == 'contact') {
        $contact_active = $active;
    }
    if ($_SESSION['user_logged']) {
        $logout = "<a href='$html_dir/?page=logout'>Logout</a>";
    }
    $display = <<< EOF
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">lightstrap</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li $home_active><a href="$html_dir/">Home</a></li>
              <li $about_active><a href="$html_dir/?page=about">About</a></li>
              <li $contact_active><a href="$html_dir/?page=contact">Contact</a></li>
            </ul>
            <ul class="nav secondary-nav" style="float:right;">
                <li>$logout</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
EOF;
return $display;
}

function displayMain() {
    $signInContent = displaySignInContent();
    $signUpContent = displaySignUpContent();
    
    // hero unit style  style="background-image:url('');background-repeat:no-repeat;"
    $display = <<< EOF
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>lightstrap</h1>
        <p>Uses Twitter Bootstrap as the frontend and the gravity-framework as the backend.</p>
        <p><a class="btn btn-primary btn-large" data-toggle="modal" href="#myModal">Sign In &raquo;</a></p>
      </div>
      
      <!-- Sign in modal -->
      
      <div class="modal hide fade" id="myModal" style="display: none; ">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">×</button>
          <h3>Sign In</h3>
        </div>
        <div class="modal-body">
          $signInContent
            &nbsp;&nbsp;&nbsp;Or
            <br /><br />
            <a class="btn" data-dismiss="modal" data-toggle="modal" href="#registerModal">Sign Up &raquo;</a>
            </p>    
        </p>
        </div>
        <div class="modal-footer">
          <!--<a href="#" class="btn btn-primary">Save changes</a>-->
        </div>
      </div>
      
      
      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Contact Us</h2>
            <p>
                This will take you to the contact page.
           </p>
          <p><a class="btn" href="/?page=contact">Contact &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>About</h2>
           <p>
              This framework was made for the rapid development of webapps and the incorporation of 
              twitter bootstrap helps accomplish this by including a visually appealing front end
              framework as well.
           </p>
          <p><a class="btn" href="/?page=about">About &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Sign Up</h2>
          <p>
            Signing up with twitter, facebook, openid, and native signup coming soon.
          </p>
          <p><a class="btn" data-toggle="modal" href="#registerModal">Sign Up &raquo;</a></p>
        </div>
        <div class="modal hide fade" id="registerModal" style="display: none; ">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Sign Up</h3>
          </div>
          
          <!-- Sign up modal -->
          
          <div class="modal-body">
            $signUpContent
            <p>
            &nbsp;&nbsp;&nbsp;Or
            <br /><br />
            <a class="btn" data-dismiss="modal" data-toggle="modal" href="#myModal">Sign In &raquo;</a>
            </p>
            </p>
          </div>
          
        </div>
      </div>
      <hr class="span12">
EOF;
return $display;
}

function displayFooter() {
    $display = <<< EOF
    
    <footer class="span12">
        <p>&copy; Author 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script>
        $(function(){
            $('#input07').datepicker({
                format: 'mm-dd-yyyy'
            });
        });
    </script>
  </body>
</html>
EOF;
return $display;
}

function displayAbout() {
$display = <<< EOF
    <h1>About</h1>
    <p>
        This framework was made for the rapid development of webapps and the incorporation of 
        twitter bootstrap helps accomplish this by including a visually appealing front end
        framework as well.
    </p>
EOF;
return $display;
}

function displayContact() {
$display = <<< EOF
    <h1>Contact</h1>
    <p>
        Contact Form
    </p>
EOF;
return $display;
}

function displaySignInContent() {
    //this function displays the general sign in content that can either go in
    //a modal window or in a separate page
$display = <<< EOF
    <p>
        <form class="well" name="form-signin" method="POST" action="/?page=signin">
        <label>email</label>
        <input type="text" class="span3" placeholder="Username" name="username">
        <label>Password</label>
        <input type="password" class="span3" placeholder="Password" name="password">
        <input type="hidden" name="login-pressed" value="1">
        <br />
        <button type="submit" class="btn btn-success">Sign In</button>
        </form>
        <p>
EOF;
return $display;
}

function displaySignIn() {
    //this function displays the sign in content in its own page
    $signInContent = displaySignInContent();
$display = <<< EOF
    <h1>Sign In</h1>
    $signInContent
    &nbsp;&nbsp;&nbsp;Or
        <br /><br />
        <a class="btn" href="/?page=signup">Sign Up &raquo;</a>
        </p>
            
    </p>
EOF;
return $display;
}

function displaySignUpContent() {
    //this function displays the general sign up content that can either go in
    //a modal window or in a separate page
$display = <<< EOF
    <p>
        <form class="well" name="form-signup" method="POST" action="/?page=signup">
            <label>Email</label>
            <input type="text" class="span3" placeholder="example@example.com" name="email">
            <label>Password</label> 
            <input type="password" class="span3" placeholder="Password" name="password">
            <label>Retype Password</label>
            <input type="password" class="span3" placeholder="Retype Password" name="retyped-password">
            <input type="hidden" name="register-pressed" value="1">
            <label class="checkbox">
                <input type="checkbox" name="agree" value="yes">I Agree to the Terms of Use and Privacy Policy
            </label>
            <br />
            <button type="submit" class="btn btn-success">Sign Up</button>
        </form>
        
EOF;
return $display;
}

function displaySignUp() {
    //this function displays the sign up content in its own page
    $signUpContent = displaySignUpContent();
$display = <<< EOF
    <h1>Sign Up</h1>
    $signUpContent
    <p>
            &nbsp;&nbsp;&nbsp;Or
            <br /><br />
            <a class="btn" href="/?page=signin">Sign In &raquo;</a>
        </p>
    </p>
EOF;
return $display;
}




function displaySearch() {
$display = <<< EOF
    <div id="search">
        <form name="form" action="/search/" method="get">
            <input type="text" name="q" value="" size="20" />
            <button id="search_button" type="submit" value="Search">Search</button> 
        </form>
    </div>
EOF;
return $display;
}

function displayLogo() {
$display = <<< EOF
    <div id="logo"><a href="/gravity/">Gravity</a></div>
EOF;
return $display;
}

function displayLoginNav() {
    if ($_SESSION['user_logged']) {
        $user = $_SESSION['user_logged'];
$display = <<< EOF
    <div id="login-nav">
    <script language=javascript>
    function submitProfileLink()
    {
        document.profilelink.submit();
    }
    </script>
    <script language=javascript>
    function submitLogoutLink()
    {
        document.logoutlink.submit();
    }
    </script>
    <form action="/gravity/" name="profilelink" method="post">
            <input type="hidden" name="page" value="profile-$user">
            </form>
    <form action="/gravity/" name="logoutlink" method="post">
            <input type="hidden" name="page" value="logout">
            </form>
        <ul>
            <li><a href=# onclick="submitProfileLink()">$user</a></li>
            <li><a href=# onclick="submitLogoutLink()">Logout</a></li>
            <li>Help</li>
        </ul>
    </div>
EOF;
    } else {
$display = <<< EOF
    <div id="login-nav">
    <script language=javascript>
    function submitLoginLink()
    {
        document.loginlink.submit();
    }
    </script>
    <script language=javascript>
    function submitRegisterLink()
    {
        document.registerlink.submit();
    }
    </script>
    <form action="/gravity/" name="loginlink" method="post">
            <input type="hidden" name="page" value="login">
            </form>
    <form action="/gravity/" name="registerlink" method="post">
            <input type="hidden" name="page" value="register">
            </form>
        <ul>
            <li><a href=# onclick="submitLoginLink()">Login</a></li>
            <li><a href=# onclick="submitRegisterLink()">Register</a></li>
            <li>Help</li>
        </ul>
    </div>
EOF;
    }
return $display;
}

function displayNavigationArea() {
$display = <<< EOF
    <div id="navigationarea">
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
            <li>Item 4</li>
            <li>Item 5</li>
        </ul>
    </div>
EOF;
return $display;
}

function displaySubNav() {
$display = <<< EOF
    <div id="subnav"></div>
EOF;
return $display;
}

function displayPageLeft($page) {
$display = <<< EOF
    <div id="page-left">
        $page
    </div>
EOF;
return $display;
}

function displayPageRight() {
$display = <<< EOF
    <div id="page-right">
        
    </div>
EOF;
return $display;
}

function displayLogin() {
    //<td>Remember me:</td><td><input type="checkbox" name="remember"></td>
$display = <<< EOF
    <div id="login">
        <table>
        <form name="form1" method="post" action="/gravity/">
        <tr>
            <td>Username:</td><td><input name="name" type="text" id="name" value="$name" /></td>
        </tr>
        <tr>
            <td>Password:</td><td><input name="password" type="password" id="password" /></td>
        </tr>
            <input name="login_pressed" type="hidden" value="1">
        <tr>
        <td></td><td align="right"><input type="submit" name="submit" value="Login" /></td>
        </tr>
        </form>
        </table>
    </div>
EOF;
return $display;
}

function displayRegister() {
    //require_once('/var/www/class/recaptchalib.php');
    //$publickey = "6Lf-0roSAAAAABs6gkWoTG45HfeCdjy1blUj9Nqv"; // you got this from the signup page
    //echo recaptcha_get_html($publickey);
    //tr><td>reCaptcha</td><td><?php</td></tr>
$display = <<< EOF
    <div id="register_form">
        <form name="form1" method="post" action="/gravity/">
        <table>
            <tr><td>Username:</td><td><input name="name" type="text" id="name" value="$name" /></td></tr>
            <tr><td>Password:</td><td><input name="password" type="password" id="password" value="$password" /></td></tr>
            <tr><td>email:</td><td><input name="email" type="text" id="email" value="$email" /></td></tr>
            <input name="register_pressed" type="hidden" value="1">
            <tr><td>I Agree to the <br /><a class="iframe_ajax" href="/class/terms_of_use.php">Terms of Use</a> and <br /><a class="iframe_ajax" href="/class/privacy_policy.php">Privacy Policy</a></td><td><input type="submit" name="submit" value="Register" /></td></tr>
        </table>
        </form>
    </div>
EOF;
return $display;
}

function displayRegisterSuccess() {

$display = <<< EOF
    <p>
        Successfully Registered!
    </p>
    <p>
        <a href="/gravity/">Go to the Homepage</a>
    </p>
    <p>
        <a href="/gravity/">Go to your profile</a>
    </p>
    
EOF;
return $display;
}

function displayProfileLogged($name) {
    
    $photo = varProfilePhoto($name);
$display = <<< EOF
    <div id="profile">
        <div id="profile-left">
            <div id="user_photo">
                <img src="/gravity/photos/$photo" />
            </div>
        </div>
        <div id="profile-right">
            <h2>$name</h2>
        </div>
    </div>
EOF;
return $display;
}

function displayProduct($product_id) {    
    $photo = varProductPhoto($product_id);
    $title = varProductTitle($product_id);
    $description = varProductDescription($product_id);
    $company = varProductCompany($product_id);
    $price = varProductPrice($product_id);
    $stars = displayStars($product_id);
    $reviews = displayReviews($product_id);

$display = <<< EOF
    <div id="product">
        <div id="product-photo">
            <img src="/gravity/photos/$photo" />
        </div>
        <div id="title">
            <p>$title</p>
        </div>
        <div id="description">
            <p>$description</p>
        </div>
        <div id="company">
            <p>$company</p>
        </div>
        <div id="price">
            <p>$price</p>
        </div>
        $stars
        <div id="reviews">
        
        </div>
        
    </div>
EOF;
return $display;
}

function displayStars($product_id) {
    $average = varProductRating($product_id);
    if ($average == 0) {
        //no stars write a review
    } else {
        $ave = round($average);
        if ($ave == 1) {
            $stars = '<img src="1-star.png" />';
        } elseif ($ave == 2) {
            $stars = '<img src="2-star.png" />';
        } elseif ($ave == 3) {
            $stars = '<img src="3-star.png" />';
        } elseif ($ave == 4) {
            $stars = '<img src="4-star.png" />';
        } elseif ($ave == 5) {
            $stars = '<img src="5-star.png" />';
        }
    }
    
$display = <<< EOF
    <div id="stars">
        $stars
    </div>
EOF;
return $display;
}

function displayReviews($product_id) {
    
}

?>