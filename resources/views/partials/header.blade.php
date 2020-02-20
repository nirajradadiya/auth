<div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
    	<!-- BEGIN LOGO -->
    	<div class="page-logo">
    		<a href="{{ADMIN_URL}}">  
    		<img src="{{ SITE_URL }}public/img/logo.png" alt="logo"  alt="logo" class="logo-default"/>
    		</a>
    		
    	</div>
        <?php ?>
    	<!-- END LOGO -->
    	<!-- BEGIN HEADER SEARCH BOX -->
    	<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
    	<!-- END HEADER SEARCH BOX -->
    	<!-- BEGIN RESPONSIVE MENU TOGGLER -->
    	<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    	</a>
    	<!-- END RESPONSIVE MENU TOGGLER -->
    	<!-- BEGIN TOP NAVIGATION MENU -->
    	<div class="top-menu">
            <?php if(!isset($currentUser) || empty($currentUser)){
                    $currentUser = Auth::guard('admin')->user();

            }?>
    		<ul class="nav navbar-nav pull-right">
    			<!-- BEGIN USER LOGIN DROPDOWN -->
    			<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
    			<li class="dropdown dropdown-user">
    				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    				<img alt="" class="img-circle" src="<?php if(File::exists(ADMIN_PROFILE_PATH.$currentUser->v_image) && $currentUser->v_image !='') { echo SITE_URL.'public/'.ADMIN_PROFILE_PATH.$currentUser->v_image; } else { echo SITE_URL.'public/img/avatar1.png'; }?>"/>
    				<span class="username username-hide-on-mobile">
    				{{$currentUser->v_name}}</span>
    				<i class="fa fa-angle-down"></i>
    				</a>
    				<ul class="dropdown-menu dropdown-menu-default">
    					<li>
    						<a href="{{action('Admin\AdminAuthenticateController@my_profile')}}">
    						<i class="icon-user"></i> My Profile </a>
    					</li>
            			<li>
    						<a href="{{action('Admin\AdminAuthenticateController@logout')}}">
    						<i class="icon-key"></i> Log Out </a>
    					</li>
                    </ul>
    			</li>
    			<!-- END USER LOGIN DROPDOWN -->			
    		</ul>
    	</div>
    	<!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
   
</div>
<!-- END HEADER -->

<div class="clearfix">
</div>