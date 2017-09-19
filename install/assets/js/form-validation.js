var install= function () {

    var installForm = function () {
        $('#install_form').validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                     hostname: {
                        required: true,
                        minlength: 6,
                    },
                    username: {
                        required: true,
                        minlength: 4,
                    },                      
                    database: {
                        required: true,
                        minlength: 4,
                    },
                    first_name: {
                        required: true,
                        minlength: 2,
                    },
                    last_name: {
                        required: true,
                        minlength: 3,
                    }, 
                    email: {
                        required: true,
                        email: true
                    },
                    u_password: {
                        required: true,
                        minlength: 6,
                    },
                    protocol: {
                        required: true,
                        minlength: 3,
                    },
                    smtp_host: {
                        required: true,
                        minlength: 5,
                    },
                    smtp_user: {
                        required: true,
                        minlength: 5,
                    },
                    smtp_pass: {
                        required: true,
                        minlength: 5,
                    },
                    smtp_port: {
                        required: true,
						digits: true,
                        minlength: 1,
                    },
                    sess_cookie_name: {
                        required: true,
                        minlength: 3,
                    },
                    sess_expiration: {
                        required: true,
                        digits: true,
                        minlength: 3,
                    }					
                },

                messages: {
                    hostname: {
                        required: "Hostname is required.",
                        minlength: "Minimum length 6 characters",
                    },
                    username: {
                        required: "Hostname is required.",
                        minlength: "Minimum length 4 characters",
                    },            
                    database: {
                        required: "Database Name is required.",
                        minlength: "Minimum length 2 characters",
                    },
                    first_name: {
                        required: "First Name is required.",
                        minlength: "Minimum length 2 characters",
                    },
                    last_name: {
                        required: "Last Name is required.",
                        minlength: "Minimum length 3 characters",
                    },
                    u_password: {
                        required: "Password is required.",
                        minlength: "Minimum length 6 characters",
                    },
                    email: {
                        required: "Email is required.",
                        email: "Please enter a valid email address",
                    },
                    protocol: {
                        required: "Protocol is required.",
                        minlength: "Minimum length 3 characters",
                    },
                    smtp_host: {
                        required: "SMTP host is required.",
                        smtp_host: "Minimum length 5 characters",
                    },
                    smtp_user: {
                        required: "SMTP user is required.",
                        smtp_user: "Minimum length 5 characters",
                    },
                    smtp_pass: {
                        required: "SMTP password is required.",
                        smtp_pass: "Minimum length 5 characters",
                    },
                    smtp_port: {
                        required: "SMTP port is required.",
                        smtp_port: "Minimum length 1 characters",
                    },
                    sess_cookie_name: {
                        required: "Session cookie name is required.",
                        sess_cookie_name: "Minimum length 3 characters",
                    },
                    sess_expiration: {
                        required: "Session expiration is required in seconds.",
                        sess_expiration: "Minimum length 3 characters",
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   

                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });

            $('#install_form input').keypress(function (e) {
                if (e.which == 13) {
                    if ($('#install_form').validate().form()) {
                        $('#install_form').submit();                    }
                    return false;
                }
            });
        }

    
    return {
        //main function to initiate the module
        init: function () {            
            installForm();           
        }

    };

}();

jQuery(document).ready(function() {     
    install.init();
});