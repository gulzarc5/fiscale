<?php

Route::group(['namespace'=>'Admin'],function(){
    Route::get('admin/login','LoginController@index')->name('admin.login');

    Route::post('/admin/login', 'LoginController@adminLogin');
    Route::post('/admin/logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/deshboard', 'DeshboardController@index')->name('admin.deshboard');

        Route::group(['namespace'=>'Configuration'],function(){
            Route::get('Add/Class/Form', 'ClassController@addClassForm')->name('admin.add_class_form');
            Route::post('Add/Class', 'ClassController@addClass')->name('admin.add_class');
            Route::get('Class/List', 'ClassController@classList')->name('admin.class_list');
            Route::get('Class/Edit/{class_id}', 'ClassController@classEdit')->name('admin.class_edit_form');
            Route::post('Class/Update', 'ClassController@classUpdate')->name('admin.class_update');

            Route::get('Ajax/Class/List/{medium}', 'ClassController@classListAjax')->name('admin.class_list_ajax');
        });

        Route::group(['namespace'=>'Configuration'],function(){
            Route::get('Add/New/Admission/Fee', 'AdmsnFeesController@addFeeForm')->name('admin.add_new_fee_form');
            Route::post('Add/Admission/Fee', 'AdmsnFeesController@addAdmsnFee')->name('admin.add_admsn_fee');
            Route::get('Admsn/Fees/List', 'AdmsnFeesController@FeesList')->name('admin.admsn_fees_list');
            Route::post('Admsn/Search/Fees', 'AdmsnFeesController@searchFees')->name('admin.search_admsn_fees');
            Route::get('Admsn/Fees/Edit/Form/{fee_id}', 'AdmsnFeesController@admsnFeeEditForm')->name('admin.admsn_fee_edit_form');
            Route::post('Admsn/Fee/Update', 'AdmsnFeesController@admsnFeeUpdate')->name('admin.admsn_fee_update');
            Route::get('Admsn/Fee/Status/{id}/{status}', 'AdmsnFeesController@admsnFeeStatus')->name('admin.admsn_fee_status');

            Route::group(['prefix'=>'Promotion'],function(){
                Route::get('Add/New/Fee', 'PromotionFeeController@addFeeForm')->name('admin.add_new_promotion_fee_form');
                Route::post('Add/Fee', 'PromotionFeeController@addFee')->name('admin.add_promotion_fee');
                Route::get('Fees/List', 'PromotionFeeController@FeesList')->name('admin.promotion_fees_list');
                Route::post('Search/Fees', 'PromotionFeeController@searchFees')->name('admin.search_promotion_fees');
                Route::get('Fees/Edit/Form/{fee_id}', 'PromotionFeeController@FeeEditForm')->name('admin.promotion_fee_edit_form');
                Route::post('Fee/Update', 'PromotionFeeController@FeeUpdate')->name('admin.promotion_fee_update');
                Route::get('Fee/Status/{id}/{status}', 'PromotionFeeController@FeeStatus')->name('admin.promotion_fee_status');
            });
        });

        Route::group(['prefix'=>'Employee'],function(){
            Route::get('Add/New/', 'EmployeeController@addEmployeeForm')->name('admin.add_employee_form');
            Route::post('Add/Emp', 'EmployeeController@addEmployee')->name('admin.add_employee');
            Route::get('List/', 'EmployeeController@employeeList')->name('admin.employee_list');
            Route::get('Edit/Form/{id}', 'EmployeeController@editEmployeeForm')->name('admin.edit_employee_form');
            Route::post('Update/Emp', 'EmployeeController@updateEmployee')->name('admin.update_employee');
            Route::get('Change/Pass/Form/{id}', 'EmployeeController@employeePassChange')->name('admin.change_pass_employee_form');

            Route::post('Change/Pass/', 'EmployeeController@employeePassChangeSubmit')->name('admin.change_pass_employee');

        });

        Route::group(['prefix'=>'Branch'],function(){
            Route::get('Add/New/', 'BranchController@addBranchForm')->name('admin.add_branch_form');
            Route::post('Add/branch', 'BranchController@addBranch')->name('admin.add_branch');
            Route::get('List/', 'BranchController@branchList')->name('admin.branch_list');
            Route::get('Edit/Form/{id}', 'BranchController@editBranchForm')->name('admin.edit_branch_form');
            Route::post('Update/branch', 'BranchController@updateBranch')->name('admin.update_branch');
            Route::get('Change/Pass/Form/{id}', 'BranchController@branchPassChange')->name('admin.change_pass_branch_form');

            Route::post('Change/Pass/', 'BranchController@branchPassChangeSubmit')->name('admin.change_pass_branch');

        });
        
    });
});