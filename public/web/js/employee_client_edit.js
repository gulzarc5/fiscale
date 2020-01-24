function enableButton() {
    $('#name').prop('disabled',false);
    $('#father_name').prop('disabled',false);
    $('#dob').prop('disabled',false);
    $('#pan').prop('disabled',false);
    $('#constitution').prop('disabled',false);
    $('#gender').prop('disabled',false);
    $('#mobile').prop('disabled',false);
    $('#email').prop('disabled',false);
    $('#flat_addr').prop('disabled',false);
    $('#village_addr').prop('disabled',false);
    $('#po_addr').prop('disabled',false);
    $('#ps_addr').prop('disabled',false);
    $('#area_addr').prop('disabled',false);
    $('#district_addr').prop('disabled',false);
    $('#state_addr').prop('disabled',false);
    $('#pin_addr').prop('disabled',false);
    $('#flat').prop('disabled',false);
    $('#village').prop('disabled',false);
    $('#po').prop('disabled',false);
    $('#ps').prop('disabled',false);
    $('#area').prop('disabled',false);
    $('#district').prop('disabled',false);
    $('#state').prop('disabled',false);
    $('#pin').prop('disabled',false);
    $('#trade_name').prop('disabled',false);
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $("#button-div").html('<button class="btn rounded" type="submit" >Save</button>');
}