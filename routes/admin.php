<?php

Route::group(['namespace'=>'Admin'],function(){
    Route::get('admin/login','LoginController@index')->name('admin.login');

    Route::post('/admin/login', 'LoginController@adminLogin');
    Route::post('/admin/logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/deshboard', 'DeshboardController@index')->name('admin.deshboard');

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
            Route::get('List/Ajax', 'BranchController@branchListAjax')->name('admin.branch_list_ajax');

            Route::get('Edit/Form/{id}', 'BranchController@editBranchForm')->name('admin.edit_branch_form');
            Route::post('Update/branch', 'BranchController@updateBranch')->name('admin.update_branch');
            Route::get('Change/Pass/Form/{id}', 'BranchController@branchPassChange')->name('admin.change_pass_branch_form');

            Route::post('Change/Pass/', 'BranchController@branchPassChangeSubmit')->name('admin.change_pass_branch');

        });

        Route::group(['prefix'=>'Customer'],function(){
            Route::get('List/', 'CustomerController@customerList')->name('admin.customer_list');
            Route::get('ajax/List/', 'CustomerController@customerAjaxList')->name('admin.customer_ajax_list');
            Route::get('view/client/{client_id}', 'CustomerController@viewClient')->name('admin.client_detail');
            Route::get('edit/client/{client_id}', 'CustomerController@clientEdit')->name('admin.client_edit');
            Route::post('edit/update', 'CustomerController@ClientUpdate')->name('admin.client_update');

            Route::get('job/list/', 'CustomerController@jobList')->name('admin.job_list');
            Route::get('job/list/ajx', 'CustomerController@jobListAjax')->name('admin.job_list_ajax');
            Route::get('view/job/{job_id}', 'CustomerController@viewJob')->name('admin.job_detail');
            Route::get('edit/job/{job_id}', 'CustomerController@editJob')->name('admin.job_edit');
            Route::post('update/job', 'CustomerController@updateJob')->name('admin.job_update');
            Route::post('job/assign/', 'CustomerController@jobAssign')->name('admin.job_assign');

            Route::post('update/remark', 'CustomerController@updateRemark')->name('admin.remark_update');
            Route::post('add/remark', 'CustomerController@addRemark')->name('admin.remark_add');

            Route::get('working/job/list/', 'CustomerController@workingJobList')->name('admin.working_job_list');
            Route::get('working/job/list/ajx', 'CustomerController@workingJobListAjax')->name('admin.working_job_list_ajax');

            Route::get('problem/job/list/', 'CustomerController@problemJobList')->name('admin.problem_job_list');
            Route::get('problem/job/list/ajx', 'CustomerController@problemJobListAjax')->name('admin.problem_job_list_ajax');

            Route::get('completed/job/list/', 'CustomerController@completedJobList')->name('admin.completed_job_list');
            Route::get('completed/job/list/ajx', 'CustomerController@completedJobListAjax')->name('admin.completed_job_list_ajax');

        });
        
    });
});