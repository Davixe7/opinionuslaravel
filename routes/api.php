<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\VoteController;

Route::apiResource([
    'surveys', SurveyController::class,
    'surveys.options', OptionController::class,
    'surveys.votes', VoteController::class
]);
