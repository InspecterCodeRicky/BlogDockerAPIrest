<?php


Route::set('error', function() {
  GetController::runController('ControllerError', 'PageNotFound');
});
Route::set('', function() {
  GetController::runController('ControllerArticles', 'showArticles');
});
Route::set('article/<1>', function() {
  GetController::runController('ControllerArticles', 'getOneArticle');
});
Route::set('login', function() {
  GetController::runController('ControllerSecurity', 'login');
});

Route::set('register', function() {
  GetController::runController('ControllerSecurity', 'register');
});
