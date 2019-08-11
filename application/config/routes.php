<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'HomeCtrl';
$route['404_override'] = 'PageController/error404';
$route['translate_uri_dashes'] = FALSE;

// Admin Routes
$route['/'] = 'HomeCtrl';

$route['login'] = 'LoginCtrl/login';
$route['logout'] = 'LoginCtrl/logout';

$route['category']['get'] = 'CategoryCtrl';
$route['category/(:num)']['get'] = 'CategoryCtrl/show/$1';
$route['category']['post'] = 'CategoryCtrl/store';
$route['check_category']['post'] = 'CategoryCtrl/check';
$route['category']['get'] = 'CategoryCtrl/list';
$route['category_status']['post'] = 'CategoryCtrl/toggle';


$route['books'] = 'BookCtrl';
$route['book'] = 'BookCtrl/booksForm/';
$route['book/(:num)'] = 'BookCtrl/booksForm/$1';
$route['book/(:num)/(:any)'] = 'BookCtrl/booksForm/$1/$2';
$route['check_books'] = 'BookCtrl/checkBooks';
$route['list-books'] = 'BookCtrl/getBooks';
$route['book_status']['post'] = 'BookCtrl/bookStatus';
$route['link-modal']['get'] = 'BookCtrl/linkForm';
$route['import-links']['post'] = 'BookCtrl/importLinks';

$route['content/(:any)'] = 'ContentCtrl/index/$1';
