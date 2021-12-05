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
// routes security user auth
Route::set('login', function() {
  GetController::runController('ControllerSecurity', 'login');
});
Route::set('register', function() {
  GetController::runController('ControllerSecurity', 'register');
});
Route::set('profile', function() {
  GetController::runController('ControllerSecurity', 'showProfile');
});


// api routes
Route::set('api/articles', function() {
  GetController::runController('ControllerArticles', 'multi');
});

Route::set('api/article', function() {
  GetController::runController('ControllerArticles', 'apiArticle');
});