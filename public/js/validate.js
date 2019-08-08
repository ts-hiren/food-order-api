var strictcheck = true;
var uniqueEmail = true;
var uniqueUser = true;
(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');
    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
            if(lengthValidate(input[i]) == false){
                showValidate(input[i],'length');
                check=false;
            }
        }
        if (!strictcheck || !uniqueEmail || !uniqueUser) {
            return false;
        }
        return check;
    });
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });
    $('.validate-form input[name=cpass]').change(function(){
        if ($(this).val() == $('.validate-form input[name=pass]').val()) {
            strictcheck = true;
        }else{
            showValidate(this);
            strictcheck = false;
        }
    });
    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if ($(input).data('required') != undefined) {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }
    }
    function lengthValidate(input) {
        if ($(input).data('maxlength') != undefined) {
            if($(input).val().trim().length > parseInt($(input).data('maxlength'))){
                return false;
            }
        }
        if ($(input).data('minlength') != undefined) {
            if($(input).val().trim().length < parseInt($(input).data('minlength'))){
                if ($(input).data('required')== undefined && $(input).val()=='') {
                    
                }else{
                    return false;
                }
            }
        }
    }
    function showValidate(input,type = 'validate') {
        var thisAlert = $(input).parent();
        if (type == 'length') {
            $(thisAlert).addClass('alert-length'); 
        }else{
           $(thisAlert).addClass('alert-validate'); 
       }
    }
    $('.validate-form .input100.unique[name=email]').change(function() {
       if ($(this).val().trim()=='') {
            showValidate(this);
            uniqueEmail = false;
            return false;
        }
        if($(this).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(this);
            uniqueEmail = false;
            return false;
        }
        var input2 = $(this);
        $.ajax({
            url: base_url('login-validate'),
            type: 'post',
            data:{email:$(this).val()},
            dataType:'json',
            success:function(response) {
                if (response.status=='true') {
                    uniqueEmail = true;
                }else{

                    showValidate(input2,'unique');
                    uniqueEmail = false;
                    return false;
                }
            },
            error: function(){
                showValidate(input2,'unique');
                uniqueEmail = false;
                return false;
            }
        });

    });
    $('.validate-form .input100.unique[name=username]').change(function() {
       if ($(this).val().trim()=='') {
            showValidate(this);
            uniqueUser = false;
            return false;
        }
        var input2 = $(this);
        $.ajax({
            url: base_url('login-validate'),
            type: 'post',
            data:{username:$(this).val()},
            dataType:'json',
            success:function(response) {
                if (response.status=='true') {
                    uniqueUser = true;
                }else{
                    $(input2).parent().addClass('alert-validate');
                    uniqueUser = false;
                    return false;
                }
            },
            error: function(){
                $(input2).parent().addClass('alert-validate');
                uniqueUser = false;
                return false;
            }
        });
    });
    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
        $(thisAlert).removeClass('alert-length');
        $(thisAlert).removeClass('alert-unique');
    }
})(jQuery);