
<div class="page-sidebar-wrapper">	
    <div class="page-sidebar navbar-collapse collapse">
        
    	<!-- BEGIN SIDEBAR MENU -->
    	<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    	<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    	<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    	<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    	<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    	<ul class="page-sidebar-menu " data-keep-expanded="false" data-slide-speed="200" data-auto-scroll="true"  ng-class="{'page-sidebar-menu-closed': settings.layout.pageSidebarClosed}">
    	<!-- data-slide-speed="200" data-auto-scroll="true"-->
    		<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
    		<li class="sidebar-search-wrapper">
    			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
    			<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
    			<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
    			<form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
    				<a href="javascript:;" class="remove">
    				<i class="icon-close"></i>
    				</a>
    			</form>
    			<!-- END RESPONSIVE QUICK SEARCH FORM -->
    		</li>
            <li class="start <?php if(Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminAuthenticateController@dashboard") { echo 'active';}?>">
    			<a href="{{ADMIN_URL.'dashboard'}}">
    			<i class="fa fa-home"></i>
    			<span class="title">Dashboard</span>
    			</a>
    		</li>
            <li class="start <?php if(Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminAdminUsersController@getIndex"  || Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminAdminUsersController@anyEdit") { echo 'active';}?>">
                <a href="{{action('Admin\AdminAdminUsersController@getIndex')}}">
                <i class="fa fa-users"></i>
                <span class="title">Admin Users</span>
                </a>
            </li>

            <li class="start <?php if(Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminRolePermissionsController@getIndex"  || Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminRolePermissionsController@anyEdit") { echo 'active';}?>">
                <a href="{{action('Admin\AdminRolePermissionsController@getIndex')}}">
                <i class="fa fa-tasks"></i>
                <span class="title">Role Permissions</span>
                </a>
            </li>
            
            <li class="start <?php if(Route::currentRouteAction() == "App\Http\Controllers\Admin\AdminAuthenticateController@my_profile") { echo 'active';}?>">
    			<a href="{{action('Admin\AdminAuthenticateController@my_profile')}}">
    			<i class="fa fa-user"></i>
    			<span class="title">My Profile</span>
    			</a>
    		</li>
            <li class="start">
    			<a href="{{action('Admin\AdminAuthenticateController@logout')}}">
    			<i class="fa fa-key"></i> Log Out 
    			</a>
    		</li>
    		
    	</ul>
    	<!-- END SIDEBAR MENU -->
    </div>			
</div>