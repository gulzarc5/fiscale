<?php
Route::group(['namespace' => 'Employee'], function () {
    Route::get('Employee/Login/Form', 'LoginController@index')->name('employee.loginForm');
    Route::post('Employee/Login', 'LoginController@employeeLogin')->name('employee.login');
    Route::post('Employee/logout', 'LoginController@logout')->name('employee.logout');

    Route::group(['middleware' => 'auth:employee', 'prefix' => 'employee'], function () {
        Route::get('/deshboard', 'DeshboardController@index')->name('employee.deshboard');

        Route::get('/close/jobs', 'JobController@closeJobForm')->name('employee.close_job_form');
    });
});

Route::group(['namespace' => 'Branch'], function () {
    Route::get('Branch/Login/Form', 'LoginController@index')->name('branch.loginForm');
    Route::post('Branch/Login', 'LoginController@branchLogin')->name('branch.login');
    Route::post('Branch/logout', 'LoginController@logout')->name('branch.logout');

    Route::group(['middleware' => 'auth:branch', 'prefix' => 'branch'], function () {
        Route::get('/deshboard', 'DeshboardController@index')->name('branch.deshboard');
        Route::get('/thankyou/{pan}/{client_id}', 'RegisterController@thankYou')->name('branch.thank_you');
        Route::get('/registrationprint/{client_id}', 'RegisterController@registrationPrint')->name('branch.registration_print');

        Route::post('/register', 'RegisterController@registerUsers')->name('branch.register_user');
        Route::get('/user/list', 'DeshboardController@branchUsers')->name('branch.user_list');

        Route::get('/user/view/{user_id}', 'DeshboardController@branchUserView')->name('branch.user_view');

        Route::get('/search/client/job/form', 'JobController@searchClientAddJobForm')->name('branch.search_client_add_job');
        Route::post('/add/job/form', 'JobController@addJobForm')->name('branch.add_job_form');
        Route::post('/add/job', 'JobController@addJob')->name('branch.add_job');

        Route::get('/track/job/form', 'JobController@trackJobForm')->name('branch.track_job_form');
        Route::post('/track/job', 'JobController@trackJob')->name('branch.track_job');
        Route::get('/job/thankyou/{client_id}', 'JobController@JobThankYou')->name('branch.job_thank_you');
        Route::get('/job/view/{job_id}', 'JobController@JobView')->name('branch.job_view');
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