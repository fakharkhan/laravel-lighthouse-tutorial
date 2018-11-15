<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//curl 'http://graph-ql-demo.softpyramid.com/graphql'
// -H 'Accept-Encoding: gzip, deflate, br'
// -H 'Content-Type: application/json'
// -H 'Accept: application/json'
// -H 'Connection: keep-alive'
// -H 'DNT: 1'
// -H 'Origin: http://graph-ql-demo.softpyramid.com'
// --data-binary '{"query":"# Write your query or mutation here\n{\n  user(id: 1)\n  {\n    name\n    email\n  }\n}"}'
// --compressed

Route::get('/test-api',function (){

    $client = new Client(); //GuzzleHttp\Client

    $headers = [
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json',
        'Origin'        => 'http://graph-ql-demo.softpyramid.com'
    ];

    $query = ['query' => '{ users { id name email} }'];

    $uri = 'http://graph-ql-demo.softpyramid.com/graphql';

    $res = $client->post($uri, [
        'query'     =>  $query,
        'headers'   =>  $headers
    ]);

    $response = $res->getBody()->getContents();
    $response = json_decode($response);

    return $response->data->users ;

});