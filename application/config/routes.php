<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// Reserved Routes
$route['default_controller'] = 'base';
$route['404_override'] = 'myerror';
$route['translate_uri_dashes'] = TRUE;

/**
 * Admin routes
 * 
 */

// 
$route['admin'] = 'admin/dashboard/login/index';
$route['admin/dashboard'] = 'admin/dashboard/account';
$route['admin/logout'] = 'admin/dashboard/account/logout';

// Customer Routes
$route['admin/customer'] = 'admin/customers/customer/index';

// Report Routes
$route['admin/report/edit/(:any)/(:num)'] = 'admin/report/handler/edit';
$route['admin/report/download/(:any)'] = 'admin/report/handler/download';
$route['admin/report/add'] = 'admin/report/handler/add';
$route['admin/report/published'] = 'admin/report/handler/index';
$route['admin/report/drafts'] = 'admin/report/draft/handler/index';
$route['admin/report/print/receipt/(:any)'] = 'admin/print/handler/receipt';
$route['admin/report/print/card/(:any)/(:num)'] = 'admin/print/handler/card';

// Blog Routes
$route['admin/blog'] = 'admin/blog/handler/index';
$route['admin/blog/add'] = 'admin/blog/handler/add';
$route['admin/blog/edit/(:num)'] = 'admin/blog/handler/edit';

// Settings
$route['admin/settings/change-password'] = 'admin/dashboard/setting/change-password';

/*** */

// Public routes
$route['blog']  = 'blog/index';
$route['blog/(:any)']  = 'blog/article/$1';
$route['blog/articles/all/page/(:num)']  = 'blog/all';
$route['about'] = 'base/about';
$route['report'] = 'public/report/index';
$route['report/(:any)']  = 'public/report/display/$1';
