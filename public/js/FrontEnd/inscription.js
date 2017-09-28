function checkemail()
{
    var email=$('#email').val();

    if(email)
    {
        $.ajax({
            type: 'post',
            url: 'checkdata.php',
            data: {
                email:email,
            },
            success: function (response) {
                $( '#email_status' ).html(response);
                if(response=="OK")
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        });
    }
    else
    {
        $( '#email_status' ).html("");
        return false;
    }
}


$(document).ready(function () {
    $("#FormUser").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            birth_date: {
                required: true,
                date: true
            },
            lastname: {
                required: true
            },
            firstname: {
                required: true
            },
            adress: {
                required: true
            },
            postal_code: {
                required: true,
                digits: true
            },
            city: {
                required: true
            }
        }
    });
});