<?php

use App\Http\Controllers\Api\EventController;


Route::put('/events/{event}/update-date', [EventController::class, 'updateDate']);

