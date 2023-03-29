<?php
use Illuminate\Support\Facades\Route;

Route::middleware('demo')->get('/module1',  function(){
    return 'admin';
});
