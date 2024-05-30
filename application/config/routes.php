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
$route['home'] = "Home/index";
$route['register'] = 'home/register';
$route['email-verification/(:any)'] = "home/emailVerification/$1";
$route['login'] = 'home/login';
$route['login/(:any)'] = 'home/login/$1';
$route['search_data'] = "home/searchData";
$route['showCategoryWiseData/(:any)'] = "home/categoryWisesearchData/$1";
$route['community'] = 'home/community';
$route['community_details'] = 'home/community_details';
$route['contact'] = 'home/contact';
$route['student-dashboard'] = 'Users/index';
$route['enrolled-courses'] = 'Users/enrolledCourse';
$route['purchase-list'] = 'Users/purchaseList';
$route['profile'] = 'Users/profile';
$route['reviews'] = 'Users/reviews';
$route['edit-profile'] = 'Users/editProfile';
$route['logout'] = 'supercontrol/home/logout';
$route['consultant-dashboard'] = 'supercontrol/home';
$route['course-detail/(:any)'] = "home/courseDetail/$1";
$route['community/(:any)'] = "home/community_details/$1";
$route['forgot-password'] = "home/forgotPassword";
$route['otp-verification/(:any)'] = "home/verifyOtp/$1";
$route['course_list'] = 'Home/course_list';
$route['event-booked'] = 'Users/eventBooked';
/*------------Admin Routes------------*/
$route['admin'] = 'admin/users';
$route['dashboard'] = 'admin/dashboard/index';




// $route['about'] = 'Home/about';
// $route['term'] = 'Home/term_conditions';
// $route['privacy'] = 'Home/privacy_policy';
// $route['refund'] = 'Home/refund_policy';
// $route['page/faqs'] = 'Home/faqs';
// $route['youth'] = 'Home/youth';
// $route['blog'] = 'Home/blog';
// $route['blog-details/(:any)'] = 'Home/blog_details/$1';
// $route['store'] = 'Home/store';
// $route['event'] = 'Home/event';
// $route['event/(:any)'] = "home/event_details/$1";
// $route['product_list'] = 'Home/product_list';
// $route['product_details/(:any)'] = 'Home/product_details/$1';
// $route['portfolio9'] = 'Home/portfolio9';
// $route['portfolio8'] = 'Home/portfolio8';
// $route['portfolio7'] = 'Home/portfolio7';
// $route['institute'] = 'Home/institute';
// $route['network'] = 'Home/network';
// $route['newsletter'] = 'Home/newsletter';
// $route['foundation'] = 'Home/foundation';
// $route['business_women'] = 'Home/business_women';
// $route['programme_forum'] = 'Home/programmeForum';
// $route['mak_09'] = 'Home/mak_zeronine';
// $route['mak_08'] = 'Home/mak_eight';
// $route['programme_sejour'] = 'Home/programme_sejour';
// $route['programme_mak8'] = 'Home/programme_mak8';
// $route['conferences'] = 'Home/conferences';
// $route['makutano_analytics'] = 'Home/makutano_analytics';
// $route['work_documents'] = 'Home/work_documents';
// $route['raba_arbi'] = 'Home/raba_arbi';
// $route['sponsorship'] = 'Home/sponsorship';
// $route['others_info'] = 'Home/others_info';
// $route['partenaires_08'] = 'Home/partenaires_08';
// $route['partenaires_07'] = 'Home/partenaires_07';
// $route['intervenants'] = 'Home/intervenants';
// $route['livre_blanc'] = 'Home/livre_blanc';
// $route['program'] = 'Home/program';
// $route['thematiques'] = 'Home/thematiques';
// $route['communique_de_presse_bilan'] = 'Home/communique_de_presse_bilan';
// $route['conference/(:any)'] = 'Home/conference_details/$1';
// $route['statuts'] = 'Home/statuts';
// $route['category/(:any)'] = 'Home/categoryWiseList/$1';
// $route['cart'] = 'Home/cart';
// $route['checkout'] = "home/checkout";
// $route['email_unsubscribe/(:any)'] = 'Home/email_unsubscribe';
// $route['course-list'] = 'home/courseList';
// $route['consulting'] = 'home/consulting';
// $route['course-enrollment/(:any)'] = "home/courseEnrollment/$1";
// $route['success/(:any)'] = "home/success/$1";;
// $route['product-order-list'] = 'Users/productOrderList';
// $route['search-query'] = 'Home/search_query';
// $route['unsubscribe/(:any)'] = 'Home/unsubscribe/$1';
// $route['newsletterEmailSend'] = 'Home/newsletterEmailSend';
//$route['powerspeech'] = 'admin/homecourse/powerspeech';