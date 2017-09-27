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
    // $(document).ready(function () {
    //     var options = {
    //         url: "/ressources/ville.json",
    //
    //         getValue: "code",
    //
    //         list: {
    //             match: {
    //                 enabled: true
    //             }
    //         }
    //     };
    //     $("#autocomplete").easyAutocomplete(options);
    // });
});

