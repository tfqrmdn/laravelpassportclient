<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Use Illuminate\Http\Request;

Route::get('/', function () {
    // return view('welcome');
    $query = http_build_query([
      'client_id' => 3,
      'redirect_uri' => 'http://client.local/callback',
      'response_type' => 'code',
      'scope' => ''
    ]);

    return redirect('http://oauth2.local/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://oauth2.local/oauth/token', [
      'form_params' => [
        'grant_type' => 'authorization_code',
        'client_id' => 3,
        'client_secret' => 'zimCipGNSHCdzT4yH2LVQ36LU2gUxlAkzDScNTc7',
        'redirect_uri' => 'http://client.local/callback',
        'code' => $request->code,
      ],
    ]);

    return json_decode((string) $response->getBody(), true);
});
