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

            Route::get('job/add/client/search/{search_key}','ClientController@addJobClientSearch');
            Route::post('job/add/existing/client','ClientController@addJobExistingClient');

            Route::get('client/search/{search_key}','ClientController@clientSearch');
            Route::get('job/search/{job_id}','ClientController@jobSearch');

            
            Route::get('open/jobs/{sp_id}/{page_no}','ClientController@openJobs');

            Route::post('add/job/remarks','ClientController@addJobRemarks');

            Route::post('wallet/balance/add','TransactionController@AddWalletBalance');
            Route::get('wallet/payment/request/id/{order_id}/{payment_rqst_id}','TransactionController@updatePaymentRequestId');
            Route::get('wallet/update/payment/id/{order_id}/{payment_rqst_id}/{payment_id}','TransactionController@updatePaymentId');
            Route::get('wallet/history/{sp_id}','TransactionController@walletHistory');
        });
        
    });

    Route::group(['namespace'=>'Member','prefix'=>'member'],function(){        
        Route::post('login','LoginController@memberLogin');    

        Route::group(['middleware'=>'auth:apiMember'],function(){ 
            
            Route::get('open/jobs/{member_id}/{page_no}','JobController@openJobs');
            Route::get('reject/job/{job_id}','JobController@rejectJobs');

            Route::get('details/job/{job_id}','JobController@viewJobs');

            Route::get('search/client/{search_key}','ClientController@clientSearch');
            
            Route::get('job/edit/details/{id}','JobController@jobEdit');
            Route::post('job/update','JobController@jobUpdate');

            Route::get('edit/client/{id}','ClientController@clientEdit');
            Route::post('update/client','ClientController@clientUpdate');

            Route::get('wallet/history/{member_id}/{page}','TransactionController@walletHistory');


        });
        
    });
});
