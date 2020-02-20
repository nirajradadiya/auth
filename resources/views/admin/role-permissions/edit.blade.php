@extends('layout.admin_default') @section('content')
<div class="page-content-wrapper">
    <div class="page-content">
    	<!-- BEGIN PAGE HEADER-->
    	<div>
        <!-- BEGIN PAGE CONTAINER -->
            <div class="row">
            	<div class="col-md-12">
            		<!-- Begin add form -->
                    <div tabindex="-1">
                        
                        <div class="portlet box blue-madison">
            				<div class="portlet-title">
            					<div class="caption">
            						<i class="fa fa-tasks"></i>Manage Role Permissions
            					</div>
            					<div class="tools">
            						<a href="javascript:;" class=""></a>
            					</div>
            				</div>
            				<div class="portlet-body form">
            					<!-- BEGIN FORM-->
            					<form id="frmEdit" name="frmEdit" class="form-horizontal" onsubmit="return false" action="{{action('Admin\AdminRolePermissionsController@anyEdit',$record->id)}}" redirect="{{action('Admin\AdminRolePermissionsController@getIndex')}}">
                                    <input type="hidden" name="page_name" value="edit">
                                    <div class="form-body">
            							<div class="form-group"></div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3" id="customer-label">
                                                Roles 
                                            </label>
                                            @if(!empty($permissionlist))
                                                <div class="col-md-8 sales-list-parent">
                                                        <div class="sales-list">
                                                            <label>
                                                                <input type="checkbox" class="checkboxes user_chk" value="011" id="admin_act_select_all"/> 
                                                                <span id="admin_act_select_all_label">Select All</span>
                                                            </label>
                                                        </div>
                                                        @foreach($permissionlist as $key => $val)
                                                            <div class="sales-list">
                                                                <label>
                                                                    <input type="checkbox" class="checkboxes user_chk" <?php if(in_array($permissionlist[$key]['id'],$rolepermissionslist)){?> checked <?php } ?> name="permissions[]" value="{{$val['id']}}"/> {{$val['display_name']}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        <p class="form-control-static" style="display: none;" id="users-error">Please select any permissions.</span>
                                                </div>
                                            @else
                                                <div class="col-md-8">
                                                    <p class="form-control-static font-red-sunglo bold">Permissions not found.</p> 
                                                </div>    
                                            @endif
                                     </div>
                                    </div>
            						<div class="form-actions">
            							<div class="row">
            								<div class="col-md-offset-3 col-md-9">
            									<button type="submit" id="Submit" class="btn blue-madison">Update Permissions <i class="fa fa-check-square-o "></i></button>
                               					<button type="button" class="btn default" onclick="window.location='{{action('Admin\AdminRolePermissionsController@getIndex')}}'">Cancel</button>
            								</div>
            							</div>
            						</div>
            					</form>
                  				<!-- END FORM-->
            				</div>
            				<!-- END VALIDATION STATES-->
            			</div>
                                
                    </div>
                    <!-- End add form -->
                    
            	</div>
            </div>
        </div>
    </div>
</div>
<?php Session::remove('success_message'); ?>
<script>
$(document).ready(function(){
    hadleEditForm();
    setTimeout(function(){
        $(".alert-success").fadeOut();
    },3000);
     
});
</script>

<!-- END PAGE CONTENT --> 
@endsection    