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
            Route::get('status/update/{id}/{status}', 'EmployeeController@statusUpdateEmployee')->name('admin.employee_status_update');

            Route::post('Change/Pass/', 'EmployeeController@employeePassChangeSubmit')->name('admin.change_pass_employee');
            
            Route::get('debit/wallet/form/{emp_id}', 'EmployeeController@debitWalletForm')->name('admin.employee_debit_wallet_form');
            Route::post('debit/wallet/', 'EmployeeController@debitWallet')->name('admin.employee_debit_wallet');
            Route::get('credit/wallet/form/{emp_id}', 'EmployeeController@creditWalletForm')->name('admin.employee_credit_wallet_form');
            Route::post('credit/wallet/', 'EmployeeController@creditWallet')->name('admin.employee_credit_wallet');

            Route::get('credit/wallet/history/{emp_id}', 'EmployeeController@walletHistory')->name('admin.employee_wallet_history');
        });

        Route::group(['prefix'=>'Executive'],function(){
            Route::get('Add/New/', 'ExecutiveController@addExecutiveForm')->name('admin.add_executive_form');
            Route::post('Add/Exe', 'ExecutiveController@addExecutive')->name('admin.add_executive');
            Route::get('List/', 'ExecutiveController@executiveList')->name('admin.executive_list');
            Route::get('Edit/Form/{id}', 'ExecutiveController@editExecutiveForm')->name('admin.edit_executive_form');
            Route::post('Update/Exe', 'ExecutiveController@updateExecutive')->name('admin.update_executive');
            Route::get('Change/Pass/Form/{id}', 'ExecutiveController@executivePassChange')->name('admin.change_pass_executive_form');
            Route::get('status/update/{id}/{status}', 'ExecutiveController@statusUpdateExecutive')->name('admin.executive_status_update');

            Route::post('Change/Pass/', 'ExecutiveController@executivePassChangeSubmit')->name('admin.change_pass_executive');


            Route::get('debit/wallet/form/{exe_id}', 'ExecutiveController@debitWalletForm')->name('admin.executive_debit_wallet_form');
            Route::post('debit/wallet/', 'ExecutiveController@debitWallet')->name('admin.executive_debit_wallet');
            Route::get('credit/wallet/form/{exe_id}', 'ExecutiveController@creditWalletForm')->name('admin.executive_credit_wallet_form');
            Route::post('credit/wallet/', 'ExecutiveController@creditWallet')->name('admin.executive_credit_wallet');

            Route::get('credit/wallet/history/{exe_id}', 'ExecutiveController@walletHistory')->name('admin.executive_wallet_history');
        });

        Route::group(['prefix'=>'Wallet'],function(){
            Route::get('executive/report/Form','ExecutiveWalletController@executiveJobReportForm')->name('admin.executive_job_report_form');
            Route::post('executive/job/report/search','ExecutiveWalletController@executiveJobReportSearch')->name('admin.executive_job_report_search');
            Route::post('executive/job/commission/wallet/credit','ExecutiveWalletController@executiveJobCommissionCredit')->name('admin.executive_job_comm_credit');


            Route::get('employee/report/Form','EmployeeWalletController@employeeJobReportForm')->name('admin.employee_job_report_form');
            Route::post('employee/job/report/search','EmployeeWalletController@employeeJobReportSearch')->name('admin.employee_job_report_search');
            Route::post('employee/job/commission/wallet/credit','EmployeeWalletController@employeeJobCommissionCredit')->name('admin.employee_job_comm_credit');
        });


        Route::group(['prefix'=>'Branch'],function(){
            Route::get('Add/New/', 'BranchController@addBranchForm')->name('admin.add_branch_form');
            Route::post('Add/branch', 'BranchController@addBranch')->name('admin.add_branch');
            Route::get('List/', 'BranchController@branchList')->name('admin.branch_list');
            Route::get('List/Ajax', 'BranchController@branchListAjax')->name('admin.branch_list_ajax');

            Route::get('Edit/Form/{id}', 'BranchController@editBranchForm')->name('admin.edit_branch_form');
            Route::post('Update/branch', 'BranchController@updateBranch')->name('admin.update_branch');
            Route::get('Change/Pass/Form/{id}', 'BranchController@branchPassChange')->name('admin.change_pass_branch_form');

            Route::get('status/update/{id}/{status}', 'BranchController@updateStatusBranch')->name('admin.update_status_branch');

            // Route::get('pending/payment/request', 'BranchController@pandingPaymentRequest')->name('admin.pending_payment_request');
            // Route::get('pending/payment/request/ajax', 'BranchController@pandingPaymentRequestAjax')->name('admin.pending_payment_request_ajax');
            // Route::get('view/payment/request/{request_id}', 'BranchController@viewPaymentRequest')->name('admin.view_payment_request');
            // Route::get('payment/request/process/{request_id}/{request_type}', 'BranchController@processPaymentRequest')->name('admin.process_payment_request');

            // Route::get('payment/request/image/{request_id}', 'BranchController@imagePaymentRequest')->name('admin.image_payment_request');

            Route::post('Change/Pass/', 'BranchController@branchPassChangeSubmit')->name('admin.change_pass_branch');


            Route::get('debit/wallet/form/{branch_id}', 'BranchController@debitWalletForm')->name('admin.branch_debit_wallet_form');
            Route::post('debit/wallet/', 'BranchController@debitWallet')->name('admin.branch_debit_wallet');
            Route::get('credit/wallet/form/{branch_id}', 'BranchController@creditWalletForm')->name('admin.branch_credit_wallet_form');
            Route::post('credit/wallet/', 'BranchController@creditWallet')->name('admin.branch_credit_wallet');

            Route::get('credit/wallet/history/{exe_id}', 'BranchController@walletHistory')->name('admin.branch_wallet_history');

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
            Route::get('job/assign/remove/{job_id}', 'CustomerController@jobAssignRemove')->name('admin.job_assign_remove');

            Route::post('update/remark', 'CustomerController@updateRemark')->name('admin.remark_update');
            Route::post('add/remark', 'CustomerController@addRemark')->name('admin.remark_add');

            Route::get('working/job/list/', 'CustomerController@workingJobList')->name('admin.working_job_list');
            Route::get('working/job/list/ajx', 'CustomerController@workingJobListAjax')->name('admin.working_job_list_ajax');

            Route::get('problem/job/list/', 'CustomerController@problemJobList')->name('admin.problem_job_list');
            Route::get('problem/job/list/ajx', 'CustomerController@problemJobListAjax')->name('admin.problem_job_list_ajax');

            Route::get('completed/job/list/', 'CustomerController@completedJobList')->name('admin.completed_job_list');
            Route::get('completed/job/list/ajx', 'CustomerController@completedJobListAjax')->name('admin.completed_job_list_ajax');

            Route::get('empRejected/job/list/', 'CustomerController@empRejectedJobList')->name('admin.empRejected_job_list');
            Route::get('empRejected/job/list/ajx', 'CustomerController@empRejectedJobListAjax')->name('admin.empRejected_job_list_ajax');

            Route::get('customer/detail/export/{id}','CustomerController@customerInfoExport')->name('admin.customer_info export');

        });

        Route::group(['prefix'=>'report','namespace'=>'Report'],function(){
            Route::get('users/','UsersReportController@usersReportForm')->name('admin.users_report_form');
            
            Route::get('member/list','UsersReportController@memberList')->name('admin.member_list_report');
            Route::get('executive/list','UsersReportController@executiveList')->name('admin.executive_list_report');            
            Route::get('sp/list','UsersReportController@spList')->name('admin.sp_list_report');

                     
            Route::get('job/form','UsersReportController@jobReportForm')->name('admin.job_report_form');            
            Route::post('job/search/export','UsersReportController@jobSearchExport')->name('admin.job_search_export');
        });
        
    });
});