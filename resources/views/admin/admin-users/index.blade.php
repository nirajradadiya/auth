@extends('layout.admin_default')
@section('content')
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div>
    	<!-- BEGIN MAIN CONTENT -->
    	<div class="row">
    		<div class="col-md-12">
    			<div class="portlet">
    				<div class="portlet-title">
    					<div class="caption">
    						<i class="fa fa-users">
    						</i>
    						Admin Users List
    					</div>
                        
    				</div>
    				<div class="portlet-body">
                	<div class="table-container">
                    <?php
                        $success_message = Session::get('success_message');
                        if($success_message) { ?> 
                            <div class="Metronic-alerts alert alert-success fade in">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <i class="fa-lg fa fa-check "></i> 
                                <span class="message"> <?php echo $success_message;?> </span>
                            </div>
                        <?php } ?>
                        <div class="Metronic-alerts alert alert-success fade in" style="display: none;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                            <i class="fa-lg fa  fa-check "></i> 
                            <span class="message"> </span>
                        </div>
                        
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                			<thead>
                				<tr role="row" class="heading">
                                	<th>User Name</th>
                                    <th>Email-Id</th>
                                    <th>Roles</th>
                					<th class="sorting_disabled">Actions</th>
                				</tr>
                				<tr role="row" class="filter">
                                   <td>
                                       <select class="form-control form-filter input-sm" name="v_name">
                                            <option value="">Select...</option>
                                            @foreach($userslist as $key => $val)
                                                <option value="{{$key}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                					</td>
                                    <td rowspan="1" colspan="1">
                                        <input type="text" class="form-control form-filter input-sm" name="v_email"/>
            						</td>
                                    <td></td>
                					<td rowspan="1" colspan="1">
            							<div class="margin-bottom-5">
            								<button class="btn btn-sm red-haze filter-submit radius_button">
            									<i class="fa fa-search">
            									</i>
            									Search
            								</button>
            							    <button class="btn btn-sm default filter-cancel btn-circle">
            									<i class="fa fa-times">
            									</i>
            									Reset
            								</button>
                                        </div>
            						</td>
                				</tr>
                			</thead>
                		    <tbody></tbody>
                		</table>
                	</div>
                </div>
    			</div>
    			<!-- End: life time stats -->
    		</div>
    	</div>
    	<!-- END PAGE CONTENT-->
    </div>
	</div>
</div>
<script>
$(document).ready(function(){
    var url = '<?php echo action('Admin\AdminAdminUsersController@anyListAjax')?>';
    var columnsSort = [ { "orderable": false }, { "orderable": true },{ "orderable": false },{ "orderable": false }];
    var order = [0, "desc"];
    TableAjax.init(url, columnsSort, order);
    setTimeout(function(){
        $(".alert-success").fadeOut();
    },3000);    
});
</script>
<?php Session::remove('message');Session::remove('success_message'); ?>
@endsection