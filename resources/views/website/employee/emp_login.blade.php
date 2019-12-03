@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

<div class="container">
   <div class="login-form mx-auto d-block w-100">
      <div class="page-header text-center">
         <h1>Employee Login</h1>
      </div>
      <form action="empl_home.php" method="post" class="form-validate" _lpchecked="1">
         <div class="form-group">
            <div class="control-label">
               <label id="username-lbl" for="username" class="required invalid">Username<span class="star">&nbsp;*</span></label>
            </div>
            <div class="controls">
               <input name="username" id="username" value="" class="theme-input-style validate-username required form-control" size="25" required="required" aria-required="true" autofocus="" type="text">
            </div>
         </div>
         <div class="form-group">
            <div class="control-label">
               <label id="password-lbl" for="password" class="required">Password<span class="star">&nbsp;*</span></label>
            </div>
            <div class="controls">
               <input name="password" id="password" value="" class="theme-input-style validate-password required form-control" size="25" maxlength="99" required="required" aria-required="true" type="password">
            </div>
         </div>
         <div class="d-flex justify-content-between">
            <div class="form-group d-flex justify-content-start" style="width: 100%;">
               <div class="controls" style="width: 100%;">
                  <button type="submit" class="btn btn-primary rounded" style="width: 100%;">Log in</button>
               </div>
            </div>
         </div>
         <input name="return" value="" type="hidden"><input name="7c519d6abc4458bded19328f936cce5a" value="1" type="hidden">
      </form>
   </div>
</div>

@endsection