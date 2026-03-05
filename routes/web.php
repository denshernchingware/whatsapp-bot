<?php

use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return "hello";
});

Route::get('/send-whatsapp', [WhatsAppController::class, 'sendWhatsappMessage'])->name("sendMessage");

//Route::post('/whatsapp/webhook', [WhatsAppController::class, 'webhook']);
//Route::get('/whatsapp/webhook', function () {  return response()->json(['status' => 'ok']);
//});























//console/sms/whatsapp/learn
//twilio verification code: 5WKFHHCDY1BK9C3WV85L646G