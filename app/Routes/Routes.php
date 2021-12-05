<?php


Route::set('error', function() {
  GetController::runController('ControllerError', 'PageNotFound');
});
Route::set('', function() {
  GetController::runController('ControllerArticles', 'getAllArticles');
});
Route::set('home', function() {
  GetController::runController('ControllerArticles', 'getAllArticles');
});
// routes for articles
Route::set('article/<1>', function() {
  GetController::runController('ControllerArticles', 'getOneArticle');
});
Route::set('add-article', function() {
  GetController::runController('ControllerArticles', 'addArticle');
});
Route::set('remove-article/<1>', function() {
  GetController::runController('ControllerArticles', 'removeArticle');
});
Route::set('add-comment/<1>', function() {
  GetController::runController('ControllerComment', 'addComment');
});
Route::set('remove-comment/<1>', function() {
  GetController::runController('ControllerArticles', 'removeArticle');
});
Route::set('update-article/<1>', function() {
  GetController::runController('ControllerArticles', 'addArticle');
});

// routes security user auth
Route::set('login', function() {
  GetController::runController('ControllerSecurity', 'login');
});
Route::set('logout', function() {
  GetController::runController('ControllerSecurity', 'logOut');
});
Route::set('register', function() {
  GetController::runController('ControllerSecurity', 'register');
});
Route::set('profile', function() {
  GetController::runController('ControllerSecurity', 'showProfile');
});


// api routes
Route::setAPI('api/articles', function() {
  GetController::runController('ControllerApiArticles', 'multi');
});

Route::setAPI('api/details-article', function() {
  GetController::runController('ControllerApiArticles', 'apiArticle');
});