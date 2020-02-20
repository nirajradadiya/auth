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
					<form id="appsettingsform" name="myprofileform" method="post" action="{{ADMIN_URL.'app-settings'}}" class="form-horizontal" onsubmit="return false;">
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
							
                            @for($i=0;$i<count($record);$i++)
                            <div class="form-group">
                                @if($record[$i]['v_key'] == 'SERVICE_DOLLAR_AMOUNT')
								  <label class="control-label col-md-3"> Paypal Service Charges<span class="required"> * </span> </label>
                                @elseif($record[$i]['v_key'] == 'SERVICE_RS_AMOUNT')
                                  <label class="control-label col-md-3">PayUmoney Service Charges <span class="required"> * </span> </label>
                                @else
                                <label class="control-label col-md-3">{{ ucwords(strtolower(str_replace("_"," ",$record[$i]['v_key']))) }} <span class="required"> * </span> </label>
                                @endif
								<div class="col-md-4">
									<input type="text" value="{{$record[$i]['v_value']}}" name="{{$record[$i]['v_key']}}" class="form-control required <?php if($record[$i]['v_key'] == 'CURRENT_DOLLAR_AMOUNT' || $record[$i]['v_key'] == 'SERVICE_DOLLAR_AMOUNT' ||$record[$i]['v_key'] == 'SERVICE_RS_AMOUNT' || $record[$i]['v_key'] == 'CANCEL_OR_RESCHEDULE_APPOINTMENT_BEFORE_IN_MINUTS'){?> number <?php } ?>" placeholder="{{ ucwords(strtolower(str_replace("_"," ",$record[$i]['v_key']))) }}"/>
								</div>
							</div>
                            @endfor
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
    handleAppSettingsForm();
    setTimeout(function(){
        $(".alert-success").fadeOut();
    },3000);    
});
</script>
@endsection