/*==================================================================================
    Custom JS (Any custom js code you want to apply should be defined here).
====================================================================================*/
$(document).ready(function() {
        $('#next-1').click(function(){
                 $('#form-1').hide();
                 $('#step-2').css({"background-color": "#23d823", "color": "#fff"});
                 $('#form-2').show();    
        });
        $('#next-2').click(function(){
                 $('#form-2').hide();
                 $('#step-3').css({"background-color": "#23d823", "color": "#fff"});
                 $('#form-3').show();    
        });
        $('#form-2-previous').click(function(){
                 $('#form-1').show(); 
                 $('#form-2').hide();
                 $('#step-2').css({"background-color": "#d3d3d3", "color": "#8287a7"});
        });
        $('#form-3-previous').click(function(){
                 $('#form-2').show();
                 $('#form-3').hide();
                 $('#step-3').css({"background-color": "#d3d3d3", "color": "#8287a7"});
        });
        $('#add-more').click(function(){
                 $('#first-job-des').append('<div class="form-group"> <label>Job Description *</label> <select class="theme-input-style job-d text-uppercase" required=""><option selected="" disabled="">--SELECT JOB DESCRIPTION FROM LIST--</option><option>Income tax(B)</option><option>Income tax(E)</option><option>Gst Regd</option><option>Gst Ret</option><option>Dsc II</option><option>Dsc III</option><option>Epf</option><option>Esi</option><option>tc</option><option>Company Registration</option><option>Company Compliance</option><option>Ngo Registration</option><option>Project report</option><option>Cma</option><option>Fcra</option><option>Trade Mark</option><option>Iso Certification</option><option>Others</option><option>E-Tender</option> </select></div>');
        });
        $('a').click(function() {
                 $(this).toggleClass('active');
        });
    });