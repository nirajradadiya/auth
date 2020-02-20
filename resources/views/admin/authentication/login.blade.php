@extends('layout.login_reset')
@section('content')
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="{{ADMIN_URL_NEW}}">
	<img src="{{ SITE_URL }}img/logo.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
    <form method="post" name="loginFrm" id="loginFrm" action="{{ADMIN_URL.'post-login'}}" class="login-form">   
		@csrf
		<h3 class="form-title">SuperAdmin Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
        <?php
        if(Session::has('message')) { ?>
            <div class="alert alert-danger">
    			<button class="close" data-close="alert"></button>
    			<span> <?php echo Session::get('message'); ?> </span>
    		</div> 
        <?php } ?>
        <?php
        if(Session::has('success_message')) { ?>
            <div class="alert alert-success">
    			<button class="close" data-close="alert"></button>
    			<span> <?php echo Session::get('success_message'); ?> </span>
    		</div> 
        <?php } ?>
        <div class="forgot-success alert alert-success display-hide">
			<button class="close" data-close="alert"></button>
			<span>Password reset link has been sent to your email address. Please check your email.</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix email" value="{{Input::old('username')}}" type="text" autocomplete="off" placeholder="Email" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions clearfix">
			<!-- <label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label> -->
			<button type="submit" class="btn red-haze pull-right radius_button">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		
		<div class="forget-password">
		
		</div>
		{{ Form::close()}}        
	<!-- END LOGIN FORM -->
	
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 {{date('Y')}} &copy; {{SITE_NAME}}.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{SITE_PLUGIN_URL}}respond.min.js"></script>
<script src="{{SITE_PLUGIN_URL}}excanvas.min.js"></script> 
<![endif]-->
@endsection