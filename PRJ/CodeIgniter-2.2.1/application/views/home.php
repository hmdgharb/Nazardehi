<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title >نظر دهی</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="<?php echo asset_url()?>css/css" rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="<?php echo asset_url()?>css/normalize.css" >

    <link rel="stylesheet" href="<?php echo asset_url()?>css/style.css" media="screen" type="text/css" />

    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $this->config->base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo $this->config->base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href=<?php echo $this->config->base_url();?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="<?php echo $this->config->base_url();?>assets/css/HamidGharb.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo $this->config->base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?php echo $this->config->base_url();?>assets/js/html5shiv.js"></script>
        <script src="<?php echo $this->config->base_url();?>assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-green sidebar-collapse">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url('user/home'); ?>" class="logo">
           <b>نظرسنجی</b>
           شرکت کن
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	  <img src="<?php echo $this->config->base_url(); if(strcmp($user->gender, 'خانم') == 0){ ?>assets/img/user-female-128.png" <?php } else { ?>assets/img/user-male-128.png" <?php } ?> class="user-image" alt="User Image"/>
	
  <span class="hidden-xs"><?php echo $user->email; ?></span>
</a>
<ul class="dropdown-menu">
  <!-- User image -->
  <li class="user-header">
    <img src="<?php echo $this->config->base_url(); if(strcmp($user->gender, 'خانم') == 0){ ?>assets/img/user-female-128.png" <?php } else { ?>assets/img/user-male-128.png" <?php } ?> class="img-circle" alt="User Image" />
    <p style="direction: rtl;">
      <?php echo $user->name ." " . $user->gender; ?> ,کاربر گرامی 
      <small>تاریخ عضویت از تاریخ</small><?php echo $user->time; ?> 
    </p>
  </li>
  <!-- Menu Body -->
  <!-- Menu Footer-->
  <li class="user-footer">
    <div class="pull-left">
      <a href="<?php echo site_url('user/deleteUser'); ?>" class="btn btn-default btn-flat">انصراف</a>
    </div>
    <div class="pull-right">
      <a href="<?php echo site_url('user/logout'); ?>" class="btn btn-default btn-flat">خروج</a>
    </div>
  </li>
</ul>
</li>
</ul>
</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header" style="direction: rtl; text-align: center;">
</section>

<!-- Main content -->
<div class="row">
    <!-- Left col -->
      <!-- Custom tabs (Charts with tabs)-->
	<div style="margin: 0 auto; width: 90%;">
      <div class="box box-primary" style="direction: rtl; ">
	<!-- Tabs within a box -->
	  </br> 
	  <div style=" height: 300px;" ><p style="direction: rtl; text-align: center; height: 20%;"> <h1><?php echo $twite->content; ?></h1></p></div>
      </div><!-- /.nav-tabs-custom -->
</div>
</div>
<div style="margin: 0 auto; width: 600px;">
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title" style="direction: rtl; float: right; text-align: right;" ><?php if(strcmp($_SESSION['operation'], '') == 0){ ?>سوال اول<?php } else if(strcmp($_SESSION['operation'], 'question1') == 0){ ?>سوال دوم<?php } else if(strcmp($_SESSION['operation'], 'question2') == 0){ ?>سوال سوم<?php }  else if(strcmp($_SESSION['operation'], 'question3') == 0){ ?>سوال چهارم<?php } ?></h3>
</div>
<div class="box-body"style="direction:rtl; text-align: right;">
  <p style="direction: rtl; text-align: right;">
	آیا این جمله به سوال <?php echo $question->title; ?> ارتباطی دارد
  </p>
<form action="<?php echo site_url('user/checkAnswer'); ?>" method="POST">
	<div style="width: 25%; display: inline-block;">  
		<button class="btn btn-primary btn-block btn-lg" name="quest" value="بله" type="submit" >بله</button>
	</div>
	
	<div style="width: 25%; display: inline-block;">  
	<button class="btn btn-block btn-success btn-lg" name="quest" value="خیر" type="submit" >خیر</button>
	</div>
	<div style="width: 25%; display: inline-block;">  
		<button class="btn btn-block btn-danger btn-lg" name="quest" value="نمی دانم"  type="submit" >نمی دانم</button>
	</div>
</form>	
</div>
</div>
</div>


<!-- Main row -->
<div class="row">
<!-- Left col -->
</div><!-- /.content-wrapper -->
</div>
<footer class="main-footer">
<div class="pull-right hidden-xs">
  <b>Version</b> 1.0
</div>
<strong>Copyright &copy; 2015 <a href="">nazardehi.ir</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo $this->config->base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="<?php echo $this->config->base_url();?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $this->config->base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $this->config->base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $this->config->base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $this->config->base_url();?>assets/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $this->config->base_url();?>assets/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $this->config->base_url();?>assets/js/demo.js" type="text/javascript"></script>
  </body>
</html>
