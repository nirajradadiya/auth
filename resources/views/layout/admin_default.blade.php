<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<title>{{isset($title)?$title:''}} | {{SITE_NAME}}</title>
<meta charset="utf-8"/>
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--<meta content="width=device-width, initial-scale=1" name="viewport"/>-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href="{{SITE_PLUGIN_URL}}font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="{{SITE_PLUGIN_URL}}simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="{{SITE_PLUGIN_URL}}bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{SITE_PLUGIN_URL}}uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="{{SITE_PLUGIN_URL}}bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<link href="{{SITE_PLUGIN_URL}}jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-markdown/css/bootstrap-markdown.min.css" />
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>

<link rel="stylesheet" type="text/css" href="{{ SITE_URL }}public/css/demo.html5imageupload.css"/>
<link rel="stylesheet" type="text/css" href="{{SITE_PLUGIN_URL}}fancybox/source/jquery.fancybox.css?v=2.1.2" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ SITE_PLUGIN_URL }}datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<!-- BEGIN THEME STYLES -->
<link href="{{ SITE_URL }}public/css/components.css"  id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ SITE_URL }}public/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="{{ SITE_URL }}public/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="{{ SITE_URL }}public/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ SITE_URL }}public/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link rel="icon" type="image/x-icon" href="{{SITE_URL}}public/favicon.ico"/>
<script type="text/javascript">
	var SITE_URL = "<?php echo SITE_URL; ?>";
    var ADMIN_URL = "<?php echo ADMIN_URL; ?>"; 
    var WWW_ROOT = "<?php echo WWW_ROOT; ?>"; 
    var TEMP_IMG_PATH = "<?php echo TEMP_IMG_PATH; ?>";
    var MAX_UPLOAD_SIZE = "<?php echo MAX_UPLOAD_SIZE; ?>";
    var PROFILE_PATH = "<?php echo PROFILE_PATH; ?>";
    var INVALID_IMAGE_EXTENSION = "<?php echo INVALID_IMAGE_EXTENSION; ?>";
    var INVALID_IMAGE_SIZE = "<?php echo INVALID_IMAGE_SIZE; ?>";
</script>

<!--[if lt IE 9]>
<script src="{{SITE_PLUGIN_URL}}respond.min.js"></script>
<script src="{{SITE_PLUGIN_URL}}excanvas.min.js"></script> 
<![endif]-->
<script src="{{SITE_PLUGIN_URL}}jquery.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{SITE_PLUGIN_URL}}jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery.cokie.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{SITE_PLUGIN_URL}}fancybox/source/jquery.fancybox.js"></script>
<script src="{{SITE_PLUGIN_URL}}ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ SITE_URL }}public/js/validatation.js" type="text/javascript"></script>


<script src="{{SITE_PLUGIN_URL}}jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}datatables/plugins/bootstrap/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="{{ SITE_PLUGIN_URL }}bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="{{ SITE_PLUGIN_URL }}bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>	
<script src="{{SITE_URL}}public/js/datatable.js" type="text/javascript"></script>
<script src="{{SITE_URL}}public/js/components-form-tools.js" type="text/javascript"></script>
<script src="{{SITE_URL}}public/js/table-ajax.js" type="text/javascript"></script>

<!-- Choosen plugin js and Css for admin users section -->

<script src="{{SITE_URL}}public/js/chosenplugin/chosen.jquery.js" type="text/javascript"></script>
<link href="{{ SITE_URL }}public/css/chosen.css" rel="stylesheet" type="text/css"/>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
@include('partials.header')
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	
	@include('partials.sidebar')
    <!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	@yield('content')
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 {{date('Y')}} &copy; {{SITE_NAME}}
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->

<script src="{{SITE_PLUGIN_URL}}flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery.pulsate.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{SITE_PLUGIN_URL}}fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ SITE_URL }}public/js/metronic.js" type="text/javascript"></script>
<script src="{{ SITE_URL }}public/js/layout.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}bootbox/bootbox.min.js"></script>
<script src="{{ SITE_URL }}public/js/quick-sidebar.js" type="text/javascript"></script>
<script src="{{ SITE_URL }}public/js/demo.js" type="text/javascript"></script>
<script src="{{ SITE_URL }}public/js/index.js" type="text/javascript"></script>
<script src="{{ SITE_URL }}public/js/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Validation.init();
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
});
</script>
<script src="{{ SITE_URL }}public/js/custom_validation.js"></script>
<script src="{{ SITE_URL }}public/js/custom_script.js"></script> 
<script src="{{ SITE_URL }}public/js/html5imageupload.js" type="text/javascript"></script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>