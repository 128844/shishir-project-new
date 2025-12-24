<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'code' => 200,
        'message' => "Success. This project will hold the Huntme Job API's"
    ]);
});
