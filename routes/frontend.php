<?php
Route::group(['namespace' => 'Employee'], function () {
    Route::get('Employee/Login/Form', 'LoginController@index')->name('employee.loginForm');
    Route::post('Employee/Login', 'LoginController@employeeLogin')->name('employee.login');
    Route::post('Employee/logout', 'LoginController@logout')->name('employee.logout');

    Route::group(['middleware' => 'auth:employee', 'prefix' => 'employee'], function () {
        Route::get('/deshboard', 'DeshboardController@index')->name('employee.deshboard');
        Route::get('/reject/job/{job_id}','JobController@rejectJob')->name('employee.reject_job');

        Route::get('/close/jobs', 'JobController@closeJobForm')->name('employee.close_job_form');

        Route::get('/job/view/{job_id}', 'JobController@JobView')->name('employee.job_view');
        Route::post('/add/new/remark', 'JobController@addNewRemark')->name('employee.add_new_remark');
        Route::get('/remark/edit/{remark_id}/{job_id}/{page?}', 'JobController@remarkEdit')->name('employee.remark_edit');
        Route::post('/remark/update', 'JobController@remarkUpdate')->name('employee.remark_update');

        Route::get('/job/search/form', 'JobController@JobSearchForm')->name('employee.job_search_form');
        Route::post('/job/view/search', 'JobController@JobSearchView')->name('employee.job_search_view');
        Route::get('/job/search/view/Page/{job_id}', 'JobController@JobSearchViewPage')->name('employee.job_search_view_page');
        Route::get('/job/edit/form/{job_id}', 'JobController@JobEditForm')->name('employee.job_edit_form');
        Route::post('/job/update', 'JobController@JobUpdate')->name('employee.job_update');

        Route::get('/client/search/form', 'ClientController@ClientSearchForm')->name('employee.client_search_form');
        Route::post('/client/search', 'ClientController@ClientSearch')->name('employee.client_search');
        Route::get('/client/edit/form/{client_id}', 'ClientController@ClientEditForm')->name('employee.client_edit_form');
        Route::post('/client/update', 'ClientController@ClientUpdate')->name('employee.client_update');

        Route::get('/employee/report/form', 'JobController@employeeReportForm')->name('employee.employee_report_form');
        Route::post('/employee/report', 'JobController@employeeReport')->name('employee.employee_report');
    });
});

Route::group(['namespace' => 'Branch'], function () {
    Route::get('Branch/Login/Form', 'LoginController@index')->name('branch.loginForm');
    Route::post('Branch/Login', 'LoginController@branchLogin')->name('branch.login');
    Route::post('Branch/logout', 'LoginController@logout')->name('branch.logout');

    Route::group(['middleware' => 'auth:branch', 'prefix' => 'branch'], function () {
        Route::get('/deshboard', 'DeshboardController@index')->name('branch.deshboard');

        Route::post('/add/new/remark', 'DeshboardController@addNewRemark')->name('branch.add_new_remark');

        Route::get('/add/client', 'DeshboardController@addClient')->name('branch.add_client');
        Route::get('/thankyou/{pan}/{client_id}', 'RegisterController@thankYou')->name('branch.thank_you');
        Route::get('/registrationprint/{client_id}', 'RegisterController@registrationPrint')->name('branch.registration_print');

        Route::post('/register', 'RegisterController@registerUsers')->name('branch.register_user');
        Route::get('/user/list', 'DeshboardController@branchUsers')->name('branch.user_list');

        Route::get('/user/view/{user_id}', 'DeshboardController@branchUserView')->name('branch.user_view');

        Route::get('/search/client/job/form', 'JobController@searchClientAddJobForm')->name('branch.search_client_add_job');
        Route::post('/add/job/client/search', 'JobController@addJobClientSearch')->name('branch.add_job_client_search');
        Route::get('add/job/form/{client_id}','JobController@addJobForm')->name('branch.add_job_form');
        Route::post('/add/job', 'JobController@addJob')->name('branch.add_job');

        Route::get('/track/job/form', 'JobController@trackJobForm')->name('branch.track_job_form');
        Route::post('/track/job', 'JobController@trackJob')->name('branch.track_job');
        Route::get('/job/thankyou/{client_id}', 'JobController@JobThankYou')->name('branch.job_thank_you');
        Route::get('/job/view/{job_id}', 'JobController@JobView')->name('branch.job_view');

        Route::get('/client/edit/{client_id}', 'ClientController@clientEdit')->name('branch.client_edit');
        Route::post('/client/update', 'ClientController@ClientUpdate')->name('branch.client_update');
        
        Route::get('/client/search/Form', 'ClientController@ClientSearchForm')->name('branch.client_search_form');
        Route::post('/client/search', 'ClientController@ClientSearch')->name('branch.client_search');

        Route::get('/client/report/Form', 'JobController@JobReportForm')->name('branch.client_report_form');
        Route::post('/client/report', 'JobController@JobReport')->name('branch.client_report');

        Route::get('/payment/request/list', 'TransactionController@paymentRequestList')->name('branch.payment_request_list');
        Route::get('/payment/request/add/form', 'TransactionController@paymentRequestAddForm')->name('branch.payment_request_add_form');
        Route::post('/payment/request/add', 'TransactionController@paymentRequestAdd')->name('branch.payment_request_add');

        Route::get('/wallet/history', 'TransactionController@walletHistory')->name('branch.wallet_history');
        Route::get('/wallet/balance/add/form', 'TransactionController@walletBalanceAddForm')->name('branch.wallet_balance_add');
        Route::post('/wallet/balance/add', 'TransactionController@walletBalanceAdd')->name('branch.wallet_balance_add_submit');

        Route::get('/wallet/pay/success/{id}', 'TransactionController@walletPaySuccess')->name('branch.wallet_pay_success');

    });
});
Route::get('/', function () {
    return view('website.web.index');
})->name('website.web.index');

Route::get('/Contact', function () {
    return view('website.web.contact');
})->name('website.web.contact');

// Route::get('/Employee_login', function () {
//     return view('website.employee.emp_login');
// })->name('empl_login');

Route::get('/Branch_login', function () {
    return view('website.branch.bran_login');
})->name('branch_login');