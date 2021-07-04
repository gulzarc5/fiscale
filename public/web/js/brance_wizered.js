$(document).ready(function() {
    $('#next-1').click(function(){
        var name = $("#name").val();
        var dob = $("#dob").val();
        var pan = $("#pan").val();
        var constitution = $("#constitution").val();
        var gender = $("#gender").val();
        var mobile = $("#mobile").val();

        if (name && dob && pan && constitution && gender && mobile) {
            $('#form-1').hide();
            $('#step-2').css({"background-color": "#23d823", "color": "#fff"});
            $('#form-2').show(); 
            $("#name_error").html("");
            $("#dob_error").html("");
            $("#pan_error").html("");
            $("#constitution_error").html("");
            $("#gender_error").html("");
            $("#mobile_error").html("");
        } else {
                $("#name_error").html("<p style='color:red'>Name Input Required</p>");
                $("#dob_error").html("<p style='color:red'>Date Of Birth Input Required</p>");
                $("#pan_error").html("<p style='color:red'>Pan No Input Required</p>");
                $("#constitution_error").html("<p style='color:red'>Constitution Input Required</p>");
                $("#gender_error").html("<p style='color:red'>Gender Input Required</p>");
                $("#mobile_error").html("<p style='color:red'>Mobile Number Input Required</p>");
                if (name) {
                    $("#name_error").html("");
                }
                if (dob) {
                    $("#dob_error").html("");
                }
                if (pan) {
                    $("#pan_error").html("");
                }
                if (constitution) {
                    $("#constitution_error").html("");
                }
                if (gender) {
                    $("#gender_error").html("");
                }
                if (mobile) {
                    $("#mobile_error").html("");
                }

        }
          
    });
    $('#next-2').click(function(){
        var village_addr = $("#village_addr").val();
        var po_addr = $("#po_addr").val();
        var ps_addr = $("#ps_addr").val();
        var district_addr = $("#district_addr").val();
        var state_addr = $("#state_addr").val();
        var pin_addr = $("#pin_addr").val();

        var village = $("#village").val();
        var po = $("#po").val();
        var ps = $("#ps").val();
        var district = $("#district").val();
        var state = $("#state").val();
        var pin = $("#pin").val();
        if (village_addr && po_addr && ps_addr && district_addr && state_addr && pin_addr && village && po && ps && district && state && pin) {
            $("#village_addr_error").html("");
            $("#po_addr_error").html("");
            $("#ps_addr_error").html("");
            $("#district_addr_error").html("");
            $("#state_addr_error").html("");
            $("#pin_addr_error").html("");
            $("#village_error").html("");
            $("#po_error").html("");
            $("#ps_error").html("");
            $("#district_error").html("");
            $("#state_error").html("");
            $("#pin_error").html("");

            $('#form-2').hide();
            $('#step-3').css({"background-color": "#23d823", "color": "#fff"});
            $('#form-3').show();  
        } else {
            $("#village_addr_error").html("<p style='color:red'>Building/village Field is Required</p>");
            $("#po_addr_error").html("<p style='color:red'>P.O Field Required</p>");
            $("#ps_addr_error").html("<p style='color:red'>P.S Field Required</p>");
            $("#district_addr_error").html("<p style='color:red'>District Field Required</p>");
            $("#state_addr_error").html("<p style='color:red'>State Field Required</p>");
            $("#pin_addr_error").html("<p style='color:red'>Pin Field is Required</p>");
            $("#village_error").html("<p style='color:red'>Building/village Field is Required</p>");
            $("#po_error").html("<p style='color:red'>P.O Field Required</p>");
            $("#ps_error").html("<p style='color:red'>P.S Field Required</p>");
            $("#district_error").html("<p style='color:red'>District Field Required</p>");
            $("#state_error").html("<p style='color:red'>State Field Required</p>");
            $("#pin_error").html("<p style='color:red'>Pin Field is Required</p>");
            if (village_addr) {$("#village_addr_error").html("");}
            if (po_addr) {$("#po_addr_error").html("");}
            if (ps_addr) {$("#ps_addr_error").html("");}
            if (district_addr) {$("#district_addr_error").html("");}
            if (state_addr) {$("#state_addr_error").html("");}
            if (pin_addr) {$("#pin_addr_error").html("");}
            if (village) {$("#village_error").html("");}
            if (po) {
                $("#po_error").html("");
            }
            if (ps) {
                $("#ps_error").html("");
            }
            if (district) {
                $("#district_error").html("");
            }
            if (state) {
                $("#state_error").html("");
            }
            if (pin) {
                $("#pin_error").html("");
            }
        }
              
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
    var job_desc_count = 1;
    var job_desc = $("#job_desc").html();
    $('#add-more').click(function(){
        job_desc_count++;
        var job_desc_html = '<div id="job_desc_div'+job_desc_count+'" class="row half-gutter"><div class="col-md-10">'+
                    '<div class="form-group" id="job_desc">'+job_desc+'</div>'+
               ' </div>'+
                '<div class="col-md-2">'+
                    '<div class="form-group add-more">'+
                    '<label>Remove</label>'+
                    '<input style="background-color: red;" type="button" class=" btn rounded theme-input-style" value="-" onclick="removeDiv('+job_desc_count+')"> '+
                    '</div>'+
                '</div></div>'
             $('#job_desc_div').append(job_desc_html);

        $('.job_desc').select2();
    });
    $('a').click(function() {
             $(this).toggleClass('active');
    });

});

function sameCheck(){
    var x = document.getElementById("same").checked;
    if(x){
        $("#flat").val($("#flat_addr").val());
        $("#area").val($("#area_addr").val());
        $("#village").val($("#village_addr").val())
        $("#po").val($("#po_addr").val());
        $("#ps").val($("#ps_addr").val());
        $("#district").val($("#district_addr").val());
        $("#state").val($("#state_addr").val());
        $("#pin").val($("#pin_addr").val());
    }else{
        $("#flat").val("");
        $("#area").val("");
        $("#village").val("");
        $("#po").val("");
        $("#ps").val("");
        $("#district").val("");
        $("#state").val("");
        $("#pin").val("");
    }
}

function removeDiv(id){
     $("#job_desc_div"+id).remove();
}