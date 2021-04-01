<?php

require_once('./classes/route.php');
require_once('./controller/indexController.php');
require_once('./controller/usersController.php');
require_once('./controller/advertisementsController.php');

Route::set('index.php', function()
{
	indexController::createView('indexView');
});

Route::set('index', function()
{
	indexController::createView('indexView');
});

Route::set('users', function()
{
	usersController::createView('usersView',usersController::getUsers());
});

Route::set('advertisements', function()
{

	advertisementsController::createView('advertisementsView', advertisementsController::getAdvertisements());
	
});

?>