$(document).ready(function() {
        $('input[name=password]').blur(function() { //lert('blured');
            pass_confirm = $('input[name=password_confirmation]').val();
            password = $(this).val();

            if(password !== pass_confirm) {
                $('#pass-mismatch').css('display', 'block');
                $('#pass-mismatch').html('Passwords did not match');
            }else{
                $('#pass-mismatch').css('display', 'none');
                $('#pass-mismatch').html('');
            }
        })
        $('input[name=password_confirmation]').blur(function() {
            password = $('input[name=password]').val();
            pass_confirm = $(this).val();
           // alert(password);
           // alert(pass_confirm);
            if(password !== pass_confirm) {
                $('#pass-mismatch').css('display', 'block');
                $('#pass-mismatch').html('Passwords did not match');
            }else{
                $('#pass-mismatch').css('display', 'none');
                $('#pass-mismatch').html('');
            }
        })
    })
    function process_form(form)
    {
        //alert(form.phone.value);
        var validated = true;
        if (form.password.value.trim() != form.password_confirmation.value.trim()) {
            //$('#form-error').html('Passwords values does not match')
            $(form.password).css('border-color', 'red');
            validated = false;
        }
        if(validated) {
            return true;
        }else{
            return false;    
        }
        
    }