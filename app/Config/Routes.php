<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/quiz', 'Dashboard::quiz');
$routes->get('/quiz-level2', 'Dashboard::quizLevel2');
$routes->post('/complete-quiz', 'Dashboard::completeQuiz');
$routes->get('/hidden-quiz', 'Dashboard::hiddenQuiz');
$routes->get('/feedback', 'Dashboard::feedback');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->setAutoRoute(false);