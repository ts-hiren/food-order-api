<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'HomeCtrl';
$route['404_override'] = 'PageController/error404';
$route['translate_uri_dashes'] = FALSE;

// Admin Routes
$route['/'] = 'HomeCtrl';

$route['login'] = 'LoginCtrl/login';
$route['logout'] = 'LoginCtrl/logout';

$route['category'] = 'CategoryCtrl';
$route['category-modal/(:any)'] = 'CategoryCtrl/categoryForm/$1';
$route['submit-category'] = 'CategoryCtrl/addUpdateCategory';
$route['check_category'] = 'CategoryCtrl/checkCategory';
$route['list-category'] = 'CategoryCtrl/getCategory';
$route['category_status']['post'] = 'CategoryCtrl/toggle';


$route['series'] = 'SeriesCtrl';
$route['series-modal/(:any)'] = 'SeriesCtrl/seriesForm/$1';
$route['submit-series'] = 'SeriesCtrl/addUpdateSeries';
$route['check_series'] = 'SeriesCtrl/checkSeries';
$route['list-series'] = 'SeriesCtrl/getSeries';
$route['series_status']['post'] = 'SeriesCtrl/seriesStatus';

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
