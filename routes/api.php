<?php

use Illuminate\Http\Request;

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
Route::group(['namespace'=>'Api'],function(){
    
    Route::get('job/desc/list','Sp\JobController@jobDescList');

    Route::group(['namespace'=>'Sp','prefix'=>'sp'],function(){        
        Route::post('login','LoginController@spLogin');    

        Route::group(['middleware'=>'auth:apiSp'],function(){ 

            Route::post('client/registration','ClientController@clientRegistration');  
            Route::get('client/list/{sp_id}/{page}','ClientController@clientList');
            Route::get('client/jobs/{client_id}','ClientController@clientJobs');
            Route::get('client/details/{client_id}','ClientController@clientDetails');

            
            // Route::get('jobs/details/{job_id}','ClientController@JobDetails');

            Route::get('job/add/client/search/{search_key}','ClientController@addJobClientSearch');
            Route::post('job/add/existing/client','ClientController@addJobExistingClient');

            Route::get('client/search/{search_key}','ClientController@clientSearch');
        });
        
    });

});
