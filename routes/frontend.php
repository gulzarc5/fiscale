<?php

Route::get('/', function () {
    return view('website.web.index');
})->name('website.web.index');

Route::get('/Contact', function () {
    return view('website.web.contact');
})->name('website.web.contact');

Route::get('/Employee_login', function () {
    return view('website.employee.emp_login');
})->name('empl_login');

Route::get('/Branch_login', function () {
    return view('website.branch.bran_login');
})->name('branch_login');
