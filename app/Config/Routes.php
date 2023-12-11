<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

#AUTH
$routes->get('Admin', 'Authentication::signInAdmin');
$routes->get('Client', 'Authentication::signIn');
$routes->post('Authentication/signInProcess', 'Authentication::signInProcess');

#ADMIN
$routes->get('Admin/main', 'Admin::main');
#ADMIN->MOVIES
$routes->get('Admin/movies', 'Admin::movies');
$routes->get('Admin/showViewAddMovie', 'Admin::showViewAddMovie');
$routes->post('Admin/createMovie', 'Admin::createMovie');
$routes->post('Admin/movieActions', 'Admin::movieActions');
$routes->post('Admin/uploadMoviePhoto', 'Admin::uploadMoviePhoto');
$routes->post('Admin/removeMoviePhoto', 'Admin::removeMoviePhoto');
$routes->post('Admin/showViewModalMovieCreateCategory', 'Admin::showViewModalMovieCreateCategory');
$routes->post('Admin/createMovieCategory', 'Admin::createMovieCategory');
#ADMIN->GAMES
$routes->get('Admin/games', 'Admin::games');
$routes->get('Admin/showViewAddGame', 'Admin::showViewAddGame');

#HOME
$routes->get('Home/movie', 'Home::movie');