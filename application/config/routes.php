<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
| example.com/class/method/id/
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
| Please see the user guide for complete details:
| https://codeigniter.com/user_guide/general/routing.html
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
| There are three reserved routes:
| $route['default_controller'] = 'welcome';
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
$route['default_controller'] = 'home';
$route['404_override'] = 'Override';
$route['translate_uri_dashes'] = TRUE;
/*------------FrontEnd Routes----------*/
$route['home'] = 'Home/index';
$route['register'] = 'Home/register';
$route['email-verification/(:any)'] = 'Home/emailVerification/$1';
$route['login'] = 'Home/login';
$route['login/(:any)'] = 'Home/login/$1';
$route['subscription'] = 'Home/subscription';
$route['stripe/(:any)'] = 'Users/stripe/$1';
$route['thank_you/(:any)'] = "Users/thank_you/$1";
$route['search_data'] = 'Home/searchData';
$route['showCategoryWiseData/(:any)'] = 'Home/categoryWisesearchData/$1';
// $route['community'] = 'Home/community';
// $route['community_details'] = 'Home/community_details';
$route['contact'] = 'Home/contact';
$route['checkout'] = 'Home/checkout';
$route['course-detail/(:any)'] = 'Home/courseDetail/$1';
$route['community/(:any)'] = 'Home/community_details/$1';
$route['forgot-password'] = 'Home/forgotPassword';
$route['reset_password'] = 'Home/reset_password';
$route['otp-verification/(:any)'] = 'Home/verifyOtp/$1';
$route['course_list'] = 'Home/course_list';
$route['success/(:any)'] = 'Home/success/$1';
$route['student-dashboard'] = 'Users/index';
$route['enrolled-courses'] = 'Users/enrolledCourse';
$route['purchase-list'] = 'Users/purchaseList';
$route['profile'] = 'Users/profile';
$route['reviews'] = 'Users/reviews';
$route['edit-profile'] = 'Users/editProfile';
$route['community'] = 'Users/community';
$route['community_details'] = 'Users/community_details';
$route['community/(:any)'] = 'Users/community_details/$1';
$route['event-booked'] = 'Users/eventBooked';
$route['logout'] = 'supercontrol/home/logout';
$route['consultant-dashboard'] = 'supercontrol/home';
$route['supercontrol/stripe/(:any)'] = "supercontrol/Subscription/stripe/$1";
$route['supercontrol/thank_you'] = "supercontrol/Subscription/thank_you";
$route['admin'] = 'admin/users';
$route['dashboard'] = 'admin/dashboard/index';