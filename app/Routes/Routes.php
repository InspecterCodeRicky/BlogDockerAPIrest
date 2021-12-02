<?php

// This is the index page. The first route.
Route::set('error', function() {
  View::make('Error');
});

// This is the index page. The first route.
Route::set('', function() {
  View::make('articles');
});
Route::set('arcticle/<1>', function() {
  View::make('articles');
});
