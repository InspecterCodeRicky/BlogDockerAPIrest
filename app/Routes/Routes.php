<?php


Route::set('error', function() {
  GetController::runControler('error', 'error');
});
Route::set('/', function() {
  GetController::runControler('ControllerArticles', 'articles', 'showArticles');
});
Route::set('article/<1>', function() {
  GetController::runControler('ControllerArticles', 'singleArticle', 'getOneArticle');
});
Route::set('login', function() {
  GetController::runControler('ControllerSecurity', 'login', 'login');
});
