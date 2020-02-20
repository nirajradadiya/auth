@extends('layout.admin_default')
@section('content')
<div class="page-content-wrapper">
<div class="page-content">
<!-- BEGIN MAIN CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-user"></i>{{isset($title)?$title:''}}
                    </div>
                </div>
                <div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form id="myprofileform" name="myprofileform" method="post" action="{{ADMIN_URL.'my_profile'}}" class="form-horizontal" onsubmit="return false;">
                        @csrf
						<div class="form-body">
							<!--h3 class="form-section">Advance validation. <small>Custom radio buttons, checkboxes and Select2 dropdowns</small></h3-->
                            <?php 
                            $success_message = Session::get('success_message');
                            if($success_message) { ?>
    							<div class="alert alert-success">
    								<button class="close" data-close="alert"></button>
                                    <span>{{ $success_message }}</span>
    							</div>
                            <?php } ?> 
							<div class="alert alert-danger display-hide" id="validation_error">
								<button class="close" data-close="alert"></button>
								You have some form errors. Please check below.
							</div>
                            <div class="form-group"></div>
							<div class="form-group">
								<label class="control-label col-md-3">Name <span class="required"> * </span> </label>
								<div class="col-md-4">
									<input type="text" value="{{$currentUser->v_name}}" name="v_name" class="form-control required" placeholder="Name"/>
								</div>
							</div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email ID <span class="required"> * </span> </label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$currentUser->v_email}}" id="v_email" name="v_email" class="form-control required email" placeholder="Email address"/>
                                    <span class="duplicate_error temp_hid" id="v_email_duplicate_error">Email Id already exist.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password <br /><span style="font-size: 11px; color: red;">(Note: Password will be updated if entered) </label>
                                <div class="col-md-4">
                                    <input type="password" name="v_password" id="v_password" class="form-control validate_password" placeholder="Password"/>
                                    <span class="duplicate_error temp_hid" id="password_duplicate_error">New password must be diffrent from your current password.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Confirm Password </label>
                                <div class="col-md-4">
                                    <input type="password" name="cpassword" id="cpassword" equalTo="#v_password" class="form-control" placeholder="Confirm password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Profile Image </label>
                                <div class="fileinput fileinput-new col-md-9" data-provides="fileinput">
                                    <div class="tab-pane active" id="tab_1">
                                        <img width="15%" src="<?php if(File::exists(ADMIN_PROFILE_PATH.$currentUser->v_image) && $currentUser->v_image !='') { echo SITE_URL.ADMIN_PROFILE_PATH.$currentUser->v_image; } else { echo SITE_URL.ADMIN_PROFILE_PATH.'default-avatar.png'; }?>" class="img-responsive default_img_size" name="profileimg"   alt="" id="profile_pic" />
                                        <input type="hidden" id="default_img" value="<?php if(File::exists(ADMIN_PROFILE_PATH.$currentUser->v_image) && $currentUser->v_image != '') { echo '1'; } else{ echo '0';} ?> " />
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div style="margin-top: 20px;;">
                                        <button class="btn btn-default" type="button" id="file_trriger">Select Image </button>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                        <span class="label label-danger">NOTE! </span>
                                        <span>&nbsp;&nbsp;Size:150px X 150px </span>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="image_change" style="display: none;" />
                            <input type="hidden" name="frmnames" value="2"/>
                            <input type="hidden" name="imgbase64" value=""  id="imgbase64" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="x2" name="x2" />
                            <input type="hidden" id="y2" name="y2" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
                        </div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue-madison">Submit <i class="fa fa-check-square-o "></i></button>
                                     <button onclick="window.location.href=ADMIN_URL+'dashboard';" class="btn default " type="button">Cancel</button>
								</div>
							</div>
						</div>
					</form>
                    <form id="form_name" method="post" enctype="multipart/form-data">
                            <input type="file" name="file_upload" id="fileInput" style="display: none;" />
                    </form>
                    <!-- END FORM-->
				</div>
            </div>
        </div>
    </div>
</div>
</div>
<?php Session::remove('success_message'); ?>
<script src="{{SITE_PLUGIN_URL}}jcrop/js/jquery.color.js" type="text/javascript"></script>
<script src="{{SITE_PLUGIN_URL}}jcrop/js/jquery.Jcrop.min.js" type="text/javascript"></script>
<script src="{{SITE_URL}}js/image_upload.js" type="text/javascript"></script>

<script type="text/javascript" src="{{SITE_PLUGIN_URL}}bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script>
$(document).ready(function(){
    handleProfileForm();
    setTimeout(function(){
        $(".alert-success").fadeOut();
    },3000);    
});
</script>
@endsection