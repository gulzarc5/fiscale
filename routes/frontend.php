<?php
Route::group(['namespace'=>'Employee'],function(){
    Route::get('Employee/Login/Form','LoginController@index')->name('employee.loginForm');
    Route::post('Employee/Login','LoginController@employeeLogin')->name('employee.login');
    Route::post('Employee/logout', 'LoginController@logout')->name('employee.logout');

    Route::group(['middleware'=>'auth:employee','prefix'=>'employee'],function(){
        Route::get('/deshboard', 'DeshboardController@index')->name('employee.deshboard');

        Route::get('/close/jobs', 'JobController@closeJobForm')->name('employee.close_job_form');
    });

});

Route::group(['namespace'=>'Branch'],function(){
    Route::get('Branch/Login/Form','LoginController@index')->name('branch.loginForm');
    Route::post('Branch/Login','LoginController@branchLogin')->name('branch.login');
    Route::post('Branch/logout', 'LoginController@logout')->name('branch.logout');

    Route::group(['middleware'=>'auth:branch','prefix'=>'branch'],function(){
        Route::get('/deshboard', 'DeshboardController@index')->name('branch.deshboard');

        // Route::get('/close/jobs', 'JobController@closeJobForm')->name('employee.close_job_form');
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
