
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$router->get('/', function() {
    
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	if (isset($_SESSION['user'])) {
		header('Location: ' . site_url('users'));
		exit;
	}
	include __DIR__ . '/../views/users/index.php';
});
$router->match('/users/create', 'UsersController::create', ['GET', 'POST']);
$router->match('/users/update/{id}', 'UsersController::update', ['GET', 'POST']);
$router->get('/users/delete/{id}', 'UsersController::delete');
 
$router->get('/users', 'UsersController::index');
$router->match('/login', 'AuthController::login', ['GET', 'POST']);
$router->match('/signup', 'AuthController::signup', ['GET', 'POST']);
$router->get('/logout', 'AuthController::logout');
 
$router->get('/admin/users', 'UsersAdminController::index');
$router->match('/admin/users/create', 'UsersAdminController::create', ['GET', 'POST']);