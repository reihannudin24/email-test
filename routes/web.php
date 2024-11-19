<?php

use App\Http\Controllers\EmailSendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(EmailSendController::class)->group(function () {
    Route::get('/send-basic-email', 'sendBasicEmail')->name('email.basic');
    Route::get('/schedule-send-email', 'scheduleSendEmail')->name('email.schedule');
    Route::get('/blast-marketing-emails', 'blastMarketingEmails')->name('email.blast');
});
