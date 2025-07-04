<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/studentlist', 'Listing::index');
$routes->get('/leaderboard', 'Leaderboard::index');
$routes->get('/listing/getstudentdata', 'Listing::getstudentdata');
$routes->get('/add', 'Add::add');
$routes->add('/submitDetails', 'Add::submitDetails');
$routes->add('student/edit/(:any)', 'Add::edit/$1');
$routes->post('student/update/(:any)', 'Add::update/$1');
$routes->get('student/delete/(:any)', 'Add::delete/$1');
$routes->add('listing/contact', 'Listing::contact');
$routes->get('listing/get_student_marks(:any)', 'Listing::get_student_marks/$1');
$routes->get('/leaderboard', 'Listing::leaderboard');