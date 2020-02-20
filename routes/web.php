<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => ADMIN_NAME, 'middleware' => ['guest']], function () 
{
    Route::get('/',array('as' => 'form-admin-login','uses' => 'Admin\AdminAuthenticateController@getLogin'));    
    Route::post('/post-login',array('as' => 'form-admin-login-post','uses' => 'Admin\AdminAuthenticateController@postLogin'));
});

Route::group(['prefix' => ADMIN_NAME, 'middleware' => 'auth:admin'], function() 
{
	Route::any('/logout',array('uses' => 'Admin\AdminAuthenticateController@logout'));
    Route::any('/my_profile',array('uses' => 'Admin\AdminAuthenticateController@my_profile'));
    Route::any('/dashboard',array('uses' => 'Admin\AdminAuthenticateController@dashboard'));

    Route::get('admin-users', 'Admin\AdminAdminUsersController@getIndex');

    Route::post('admin-users-listajax', 'Admin\AdminAdminUsersController@anyListAjax');

    Route::any('admin-users/{adminuserid}', 'Admin\AdminAdminUsersController@anyEdit');


    Route::get('role-permissions', 'Admin\AdminRolePermissionsController@getIndex');

    Route::post('role-permissions-listajax', 'Admin\AdminRolePermissionsController@anyListAjax');

    Route::any('role-permissions/{rolepermissionid}', 'Admin\AdminRolePermissionsController@anyEdit');

}); 


Route::get('/',array('as' => 'callback-login','uses' => 'FrontPages\AuthenticateController@getCallBackLogin'));


Route::group(['prefix' => 'frontpages', 'middleware' => ['guest']], function () 
{
    Route::get('/login',array('as' => 'login','uses' => 'FrontPages\AuthenticateController@getLogin'));

});

Route::group(['prefix' => 'frontpages', 'middleware' => 'auth:web'], function() 
{
	//PRODUCT ROUTE START
	Route::group(['prefix' => 'product', 'middleware' => ['role:merchant|developer|shopkeeper']], function() 
	{
		Route::get('/', function () 
		{
			echo "<h2 style='color:green'>Product List Page Allow To Access</h2>";
		})->middleware('permission:list-product');

		Route::get('/add', function () 
		{
			echo "<h2 style='color:green'>Product Add Page Allow To Access</h2>";
		})->middleware('permission:add-product');

		Route::get('/edit', function () 
		{
			echo "<h2 style='color:green'>Product Edit Page Allow To Access</h2>";
		})->middleware('permission:edit-product');

		Route::get('/delete', function () 
		{
			echo "<h2 style='color:green'>Product Delete Page Allow To Access</h2>";
		})->middleware('permission:delete-product');
	});
	//PRODUCT ROUTE END

	//CATEGORY ROUTE START
	Route::group(['prefix' => 'category', 'middleware' => ['role:merchant|developer|shopkeeper']], function() 
	{
		Route::get('/', function () 
		{
			echo "<h2 style='color:green'>Category List Page Allow To Access</h2>";
		})->middleware('permission:list-category');

		Route::get('/add', function () 
		{
			echo "<h2 style='color:green'>Category Add Page Allow To Access</h2>";
		})->middleware('permission:add-category');

		Route::get('/edit', function () 
		{
			echo "<h2 style='color:green'>Category Edit Page Allow To Access</h2>";
		})->middleware('permission:edit-category');

		Route::get('/delete', function () 
		{
			echo "<h2 style='color:green'>Category Delete Page Allow To Access</h2>";
		})->middleware('permission:delete-category');
	});
	//CATEGORY ROUTE END

	//SLIDER IMAGE ROUTE START
	Route::group(['prefix' => 'sliderimage', 'middleware' => ['role:merchant|developer|shopkeeper']], function() 
	{
		Route::get('/', function () 
		{
			echo "<h2 style='color:green'>Slider Image List Page Allow To Access</h2>";
		})->middleware('permission:list-sliderimage');

		Route::get('/add', function () 
		{
			echo "<h2 style='color:green'>Slider Image Add Page Allow To Access</h2>";
		})->middleware('permission:add-sliderimage');

		Route::get('/edit', function () 
		{
			echo "<h2 style='color:green'>Slider Image Edit Page Allow To Access</h2>";
		})->middleware('permission:edit-sliderimage');

		Route::get('/delete', function () 
		{
			echo "<h2 style='color:green'>Slider Image Delete Page Allow To Access</h2>";
		})->middleware('permission:delete-sliderimage');
	});
	//SLIDER IMAGE ROUTE END

	Route::get('/userdetail',array('as' => 'userdetail','uses' => 'FrontPages\AuthenticateController@loginUserDetail'));

	Route::get('/logout',array('as' => 'logout','uses' => 'FrontPages\AuthenticateController@postLogout'));
});

