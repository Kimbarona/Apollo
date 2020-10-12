
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Apollo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
        <style type="text/css">
            #bgimg {
                background-image: url('images/wp4.jpg');
                background-size:100% 100%;
                /* background-color : red; */
            }
            #LogoPart {
                border-radius: 100%;
                background-image: url('images/headerlogo.png');
                /* background-color : red; */
                /* background-position: left top; */
                background-repeat: repeat;
                padding: 5px;
                width: 110px;
                height: 110px;
                margin: 0 auto;
                /* opacity: 0.3; */
                filter: alpha(opacity=50);
            }
        </style>

</head>
<?php
    include_once('outerClass.php');
    $controller = new GlobalConnection();
    $today = $controller->getDate();
?>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area" id="bgimg">
        <div class="container">
        <div id="ErrorAlert"></div>
            <div class="login-box ptb--100">
                <form method="POST" action="pages/UserAuthentication/RequestLogin.php" id="loginForm">
                 <div id="showAlert" ></div>
                    <div class="login-form-head">
                        <div id="LogoPart"></div>
                        <h5>Login To Your Account</h5>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="hidden" name="today" id="today" value="<?php echo $today?>"required>
                            <input type="text" name="userName" id="userName" required>
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="password" required>
                            <i class="ti-lock"></i>
                        </div>
                    
                        <div class="submit-btn-area">
                            <button id="btnSubmit" type="submit">Login <i class="ti-arrow-right"></i></button>
                            
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted"><strong>Date: </strong> <?php echo $today?><a href="#"></a></p>
                            <p class="text-muted">Have A Nice Day User!<a href="#"></a></p>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

