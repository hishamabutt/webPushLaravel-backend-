<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('send', function (Request $request) {
    $token = "egE4UevlJUh2x0Pd3wVNIO:APA91bFxKF27x0i1wHVfkvwbiRrYvpV2t6WS7GTFIaVTYWoFDZ-McpOIN1sbtHTla1HFY-68TFj6lSiu9insc_t2rhvriyDqOV8GpkVzxw3m43NMgFC7MWa65OHKtzrSTkv8mmzjx3mc";
    $from = "AAAAvU_lBUI:APA91bEEl5Kd2xXsDGM_rOt1xFPJCQwFysxOdNineJRJyouAaUg6qSGeRDH4nfq4q7NZXkfluFwHtQxjKOiGEBVRc9FGL-7_fEdypaeaLUilxNN8G9Splun4SSb2GIVcUrY5sl_5YKX5";
    $msg = array(
        'body'  => "Testing Testing",
        'title' => "Hi, From Raj",
        'receiver' => 'erw',
        'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
        'sound' => 'mySound'/*Default sound*/,
        'click_action' => 'https://www.google.com'
    );

    $fields = array(
        'to'        => $token,
        'notification'  => $msg
    );

    $headers = array(
        'Authorization: key=' . $from,
        'Content-Type: application/json'
    );
    //#Send Reponse To FireBase Server 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    curl_exec($ch);
    curl_close($ch);
});
