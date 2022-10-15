<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="<?php echo base_url(); ?>/app-assets/favicon.ico" rel="icon">
<title>Airpaygiving</title>
<meta name="description" content="Giving, donations, airpay">
<meta name="author" content="airpaygiving">

<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/app-assets/css2.css">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/all.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/stylesheet.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/daterangepicker.css">
<!-- Colors Css -->


<script src="https://use.fontawesome.com/d51c30f7d4.js"></script>
<!--<script src="https://kit.fontawesome.com/d51c30f7d4.js" crossorigin="anonymous"></script>-->



<style type="text/css">
.bg-primary-shade {
    background: #2786ee;
}
.bg-primary {
    background-color: #359efb !important;
}
.text-primary {
    color: #359efb !important;
}
.btn-primary {
    color: #fff;
    background-color: #359efb;
    border-color: #2786ee;
}
.btn-primary:hover {
    color: #fff;
    background-color: #2786ee;
    border-color: #359efb;
}
.scroll-top {
  background:#359efb;
}
.btn-outline-primary {
    color: #2786ee;
    background-color: transparent;
    background-image: none;
    border-color: #2786ee;
}
.btn-outline-primary:hover {
    color: #fff;
    background-color: #359efb;
    border-color: #2786ee;
}
#contact
{
  padding-top: 120px !important;
}


.wrapper {
  width: 90%;
  margin: 40px auto;
  padding: 10px;
  border-radius: 5px;
  background: white;
  box-shadow: 0px 10px 40px 0px rgba(47,47,47,.1);
}

input{
  padding: 10px;
  margin: 10px auto;
  display: block;
  border-radius: 5px;
  border: 1px solid lightgrey;
  background: none;
  width: 80%;
  color: black;
}

input:focus {
  outline: none;
}

.controls {
  width: 294px;
  margin: 15px auto;
}

#remove_fields {
  float: right;
}
.controls a i.fa-minus {
  margin-right: 5px;
}


</style>

<style>
.flex-container {
  display: flex;
   flex-wrap: wrap;
}

.flex-container > div {
  background-color: #f1f1f1;
  margin: 10px;
  padding: 20px;
  font-size: 20px;
}































/*DEMO ONLY*/
.service-categories{
  padding-top: 3em;
  padding-bottom: 3em;
  background: white;
  background-size: cover;
}
/*DEMO ONLY*/
.service-categories .card{
  transition: all 0.2s;
}
.service-categories .card-title{
  padding-top: 0.5em;
}
.service-categories a:hover{
  text-decoration: none;
}
.service-card{
  background: #359efb;
  border: 0;
}
.service-card:hover{
  background: #359efb;
  border-right: 5px solid orange;
  border-left: 5px solid orange;
}
.fa{
  color: white;
}

.card-title{
    color:white;
}
</style>

</head>
<body>

<!-- Preloader -->
<div id="preloader" style="display: none;">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End --> 

<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  <!-- Header
  ============================================= -->
<header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
          <div class="logo me-3"> <a class="d-flex" href="index.html" title="Airpaygiving"><img style="height:80px" src="<?php echo base_url(); ?>/app-assets/logo2.jpg" alt="Airpaygiving"></a> </div>
          <!-- Logo end --> 
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav"> <span></span> <span></span> <span></span> </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav me-auto">
                <li class="active"><a href="<?=base_url();?>/">Home</a></li>
                <!--
                <li class="active"><a href="<?=base_url();?>/dashboard">Dashboard</a></li>
                <li><a href="<?=base_url();?>/transactions">Transactions</a></li>
                -->
                <!--<li><a href="send-money.html">Send/Request</a></li>
                <li><a href="help.html">Help</a></li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#">Features<i class="arrow"></i></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Headers<i class="arrow"></i></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.html">Light Version (Default)</a></li>
                        <li><a class="dropdown-item" href="feature-header-dark.html">Dark Version</a></li>
                        <li><a class="dropdown-item" href="feature-header-primary.html">Primary Version</a></li>
                        <li><a class="dropdown-item" href="index-2.html">Transparent Version</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Navigation DropDown<i class="arrow"></i></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.html">Light Version (Default)</a></li>
                        <li><a class="dropdown-item" href="feature-navigation-dropdown-dark.html">Dark Version</a></li>
                        <li><a class="dropdown-item" href="feature-navigation-dropdown-primary.html">Primary Version</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Second Navigation<i class="arrow"></i></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="send-money.html">Default Version</a></li>
                        <li><a class="dropdown-item" href="deposit-money.html">Alternate Version</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Page Headers<i class="arrow"></i></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="feature-page-header-left-alignment.html">Left Alignment</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-center-alignment.html">Center Alignment</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-light.html">Light Version</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-dark.html">Dark Version</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-primary.html">Primary Version</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-custom-background.html">Custom Background</a></li>
                        <li><a class="dropdown-item" href="feature-page-header-custom-background-with-transparent-header.html">Custom Background 2</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Footer<i class="arrow"></i></a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.html">Light Version Default</a></li>
                        <li><a class="dropdown-item" href="index-2.html">Alternate Version</a></li>
                        <li><a class="dropdown-item" href="feature-footer-dark.html">Dark Version</a></li>
                        <li><a class="dropdown-item" href="feature-footer-primary.html">Primary Version</a></li>
                      </ul>
                    </li>
                    <li><a class="dropdown-item" href="feature-layout-boxed.html">Layout Boxed</a></li>
                  </ul>
                </li>
                <li class="dropdown dropdown-mega"> <a class="dropdown-toggle" href="#">Pages<i class="arrow"></i></a>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-mega-content">
                        <div class="row">
                          <div class="col-lg"> <span class="sub-title">Homepage</span>
                            <ul class="dropdown-mega-submenu">
                              <li><a class="dropdown-item" href="index.html">Home Version 1</a></li>
                              <li><a class="dropdown-item" href="index-2.html">Home Version 2</a></li>
                              <li><a class="dropdown-item" href="landing-page-send.html">Landing Page - Send</a></li>
                              <li><a class="dropdown-item" href="landing-page-receive.html">Landing Page - Receive</a></li>
                            </ul>
                          </div>
                          <div class="col-lg"> <span class="sub-title">Account</span>
                            <ul class="dropdown-mega-submenu">
                              <li><a class="dropdown-item" href="settings-profile.html">My Profile</a></li>
                              <li><a class="dropdown-item" href="settings-security.html">Security</a></li>
                              <li><a class="dropdown-item" href="settings-payment-methods.html">Payment Methods</a></li>
                              <li><a class="dropdown-item" href="settings-notifications.html">Notifications</a></li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Login<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="login.html">Login Page 1</a></li>
                                  <li><a class="dropdown-item" href="login-2.html">Login Page 2</a></li>
                                  <li><a class="dropdown-item" href="login-3.html">Login Page 3</a></li>
                                </ul>
                              </li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Signup<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="signup.html">Signup Page 1</a></li>
                                  <li><a class="dropdown-item" href="signup-2.html">Signup Page 2 </a></li>
                                  <li><a class="dropdown-item" href="signup-3.html">Signup Page 3 </a></li>
                                </ul>
                              </li>
                            </ul>
                          </div>
                          <div class="col-lg"> <span class="sub-title">Dashboard</span>
                            <ul class="dropdown-mega-submenu">
                              <li><a class="dropdown-item" href="<?=base_url();?>main/display/dashboard">Dashboard</a></li>
                              <li><a class="dropdown-item" href="<?=base_url();?>main/display/transactions">Transactions</a></li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Send Money<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="send-money.html">Send Money</a></li>
                                  <li><a class="dropdown-item" href="send-money-confirm.html">Send Money Confirm</a></li>
                                  <li><a class="dropdown-item" href="send-money-success.html">Send Money Success </a></li>
                                </ul>
                              </li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Request Money<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="request-money.html">Request Money</a></li>
                                  <li><a class="dropdown-item" href="request-money-confirm.html">Request Money Confirm</a></li>
                                  <li><a class="dropdown-item" href="request-money-success.html">Request Money Success </a></li>
                                </ul>
                              </li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Deposit Money<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="deposit-money.html">Deposit Money</a></li>
                                  <li><a class="dropdown-item" href="deposit-money-confirm.html">Deposit Money Confirm</a></li>
                                  <li><a class="dropdown-item" href="deposit-money-success.html">Deposit Money Success </a></li>
                                </ul>
                              </li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Withdraw Money<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="withdraw-money.html">Withdraw Money</a></li>
                                  <li><a class="dropdown-item" href="withdraw-money-confirm.html">Withdraw Money Confirm</a></li>
                                  <li><a class="dropdown-item" href="withdraw-money-success.html">Withdraw Money Success </a></li>
                                </ul>
                              </li>
                              <li><a class="dropdown-item" href="notifications.html">Notifications</a></li>
                            </ul>
                          </div>
                          <div class="col-lg"> <span class="sub-title">Blog</span>
                            <ul class="dropdown-mega-submenu">
                              <li><a class="dropdown-item" href="blog.html">Blog Standard</a></li>
                              <li><a class="dropdown-item" href="blog-grid.html">Blog Grid</a></li>
                              <li><a class="dropdown-item" href="blog-list.html">Blog List</a></li>
                              <li><a class="dropdown-item" href="blog-single.html">Blog Single Right Sidebar</a></li>
                              <li><a class="dropdown-item" href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a></li>
                            </ul>
                          </div>
                          <div class="col-lg"> <span class="sub-title">Others</span>
                            <ul class="dropdown-mega-submenu">
                              <li><a class="dropdown-item" href="about-us.html">About Us</a></li>
                              <li><a class="dropdown-item" href="fees.html">Fees</a></li>
                              <li><a class="dropdown-item" href="help.html">Help</a></li>
                              <li><a class="dropdown-item" href="contact-us.html">Contact Us</a></li>
                              <li><a class="dropdown-item" href="404.html">404</a></li>
                              <li><a class="dropdown-item" href="coming-soon.html" target="_blank">Coming Soon</a></li>
                              <li class="dropdown"><a class="dropdown-item dropdown-toggle" href="#">Elements<i class="arrow"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="elements.html">Elements 1</a></li>
                                  <li><a class="dropdown-item" href="elements-2.html">Elements 2</a></li>
                                </ul>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>-->
              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- My Profile
          ============================== -->   
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
                <li><a href="<?=base_url();?>/signin">Login</a></li>
                <li><a href="<?=base_url();?>/signup">Register</a></li>
              <li class="dropdown language"> <a class="dropdown-toggle" href="#">En<i class="arrow"></i></a>
                <ul class="dropdown-menu" style="">
                  <li><a class="dropdown-item" href="#">English</a></li>
                  <!--
                  <li><a class="dropdown-item" href="#">French</a></li>
                  -->
                </ul>
              </li>
              <!--
              <li class="dropdown notifications"> <a class="dropdown-toggle" href="#"><span class="text-5"><i class="far fa-bell"></i></span><span class="count">3</span><i class="arrow"></i></a>
                <ul class="dropdown-menu" style="margin-left: -168.906px;">
                  <li class="text-center text-3 py-2">Notifications (3)</li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i>A new digital FIRC document is available for you to download<span class="text-1 text-muted d-block">22 Jul 2021</span></a></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i>Updates to our privacy policy. Please read.<span class="text-1 text-muted d-block">04 March 2021</span></a></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i>Update about Payyed fees<span class="text-1 text-muted d-block">18 Feb 2021</span></a></li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item text-center text-primary px-0" href="notifications.html">See all Notifications</a></li>
                </ul>
              </li>
              <li class="dropdown profile ms-2"> <a class="px-0 dropdown-toggle" href="#"><img class="rounded-circle" src="images/profile-thumb-sm.jpg" alt=""><i class="arrow"></i></a>
                <ul class="dropdown-menu" style="margin-left: -190px;">
                  <li class="text-center text-3 py-2">Hi, Smith Rhodes</li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="settings-profile.html"><i class="fas fa-user"></i>My Profile</a></li>
                  <li><a class="dropdown-item" href="settings-Security.html"><i class="fas fa-shield-alt"></i>Security</a></li>
                  <li><a class="dropdown-item" href="settings-payment-methods.html"><i class="fas fa-credit-card"></i>Payment Methods</a></li>
                  <li><a class="dropdown-item" href="settings-notifications.html"><i class="fas fa-bell"></i>Notifications</a></li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="help.html"><i class="fas fa-life-ring"></i>Need Help?</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li>
                </ul>
              </li>
              -->
            </ul>
          </nav>
          <!-- My Profile end --> 
        </div>
      </div>
    </div>
  </header>