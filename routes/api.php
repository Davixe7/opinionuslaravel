<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\OptionController;

Route::apiResource([
    'surveys', SurveyController::class,
    'surveys.options', OptionController::class
]);
