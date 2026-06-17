<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login',            'CaisseController::login');
$routes->post('/login',           'CaisseController::doLogin');
$routes->get('/',                 'CaisseController::index');
$routes->post('/select-caisse',   'CaisseController::selectCaisse');
$routes->get('/achats',           'CaisseController::achats');
$routes->post('/achats/add',      'CaisseController::addAchat');
$routes->post('/achats/cloturer', 'CaisseController::cloturerAchat');
$routes->get('/logout',           'CaisseController::logout');
$routes->get('/full-logout',      'CaisseController::fullLogout');
