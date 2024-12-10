$(document).ready(function () {
    $(function () {
        $('#user_signup_dob').combodate({
            minYear: 1916,
            maxYear: moment().format('YYYY'),
            firstItem: 'name',
            minuteStep: 10,
            smartDays: true
        });
    });
    jQuery(window).load(function () {
        jQuery('#user-date_of_birth').combodate({
            minYear: 1916,
            maxYear: 2018,
            firstItem: 'name',
            minuteStep: 10,
            smartDays: true
        });
        (function () {
            var refDob = $('#user_signup_dob'),
                targetDob = refDob.next(),
                dateDob = targetDob.find('select:nth-child(1)'),
                monthDob = targetDob.find('select:nth-child(2)'),
                yearDob = targetDob.find('select:nth-child(3)');

            dateDob.find('option:nth-child(1)').text('DD');
            monthDob.find('option:nth-child(1)').text('MM');
            yearDob.find('option:nth-child(1)').text('YYYY');
        })();
    });

    $('#login_form').formValidation({

        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        row: {
            selector: 'label',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            user_login_email: {
                validators: {
                    notEmpty: {
                        message: 'Email / Mobile No is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkEmail(value),
                                    message: 'User Name/Email/Mobile No. is not valid',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'User Name/Email/Mobile not be greater than 100',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            user_login_password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                }
            },

        }

    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        $("#errormsgId").hide();
        var email1 = $('#user_login_email').val();
        var password1 = $('#user_login_password').val();
        var password = encode64(password1);
        var email = encode64(email1);
        var stuff = {
            'user_name': email,
            'password': password
        };
        $.ajax({
            type: "post",
            data: stuff,
            url: JS_BASE_URL + 'signin/login',
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (response) {
                if (response) {
                    responseData = jQuery.parseJSON(response);
                    $('.mainLoader').remove();
                    if (responseData.result == '1') {

                        if (responseData.user_type == 'superadmin') {
                            window.open(JS_BASE_URL + 'dashboard', '_self');
                        } if (responseData.user_type == 'admin') {
                            window.open(JS_BASE_URL + 'dashboard', '_self');
                        } if (responseData.user_type == 'write') {
                            window.open(JS_BASE_URL + 'dashboard', '_self');
                        } if (responseData.user_type == 'read') {
                            window.open(JS_BASE_URL + 'dashboard', '_self');
                        }
                    } else if (responseData.result == '3') {
                        // window.open(JS_BASE_URL + 'learn', '_self');
                        $("#errormsgId").html("Password does not match, try again");
                        $("#errormsgId").show();
                    } else {
                        $('.show-login-error').html('User credentials invalid !');
                        $('.show-login-error').css('font-size', '100% !important');
                        $('.show-login-error').css('color', '#CA0000');
                    }
                }
            }
        });
    });

    $('#forgotpassword').formValidation({

        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        row: {
            selector: 'label',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            user_login_email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkEmail(value),
                                    message: 'Email is not valid',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Email not be greater than 100',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },

        }

    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var email1 = $('#user_login_email').val();
        var email = encode64(email1);
        var stuff = {
            'user_name': email
        };
        $.ajax({
            type: "post",
            data: stuff,
            url: JS_BASE_URL + 'forgotpassword',
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (response) {
                $('.mainLoader').remove();
                $('#errorId').html('<p style="color:#fff;">' + response + '</p>');
            }
        });
    });


    $('#form-signup').formValidation({
        framework: 'bootstrap',
        autoFocus: Boolean,
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        row: {
            selector: 'label',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Name should not have special character and numbers',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Name must be less than 65 characters',
                        max: function (value, validator, $field) {
                            return 65 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },

            user_signup_emails: {
                validators: {
                    notEmpty: {
                        message: 'Email Id is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            var getusermobile = $("#user_signup_mobile").val();
                            var userMobile = '';
                            if (getusermobile != '') {
                                userMobile = getusermobile;
                            }
                            if (value != "") {
                                $("#dobcheckid").val("true");
                                $("#dobhide").hide();
                                if (checkSignupEmail(value)) {
                                    $.ajax({
                                        type: 'post', data: { 'value': userMobile, useremail: value },
                                        url: JS_BASE_URL + 'checksignupemailmob',
                                        success: function (result) {
                                            if (result == true) {
                                                $("#dobcheckid").val("false");
                                            } else {
                                                $("#dobcheckid").val("true");
                                                $("#dobhide").hide();
                                            }
                                        }
                                    });
                                }
                                return {
                                    valid: checkSignupEmail(value),
                                    message: 'Email Id is not valid',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Email Id not be greater than 100',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },

            /****Added code for Mobile*****/
            user_signup_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile No. is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            var getuseremail = $("#user_signup_email").val();
                            var useremailVal = '';
                            if (getuseremail != '') {
                                useremailVal = getuseremail;
                            }
                            if (value != "") {
                                $("#dobcheckid").val("true");
                                $("#dobhide").hide();
                                if (checkSignupMobile(value)) {
                                    $.ajax({
                                        type: 'post', data: { 'value': value, useremail: useremailVal },
                                        url: JS_BASE_URL + 'checksignupemailmob',
                                        success: function (result) {
                                            if (result == true) {
                                                $("#dobcheckid").val("false");
                                                // $("#dobhide").show();
                                            } else {
                                                $("#dobcheckid").val("true");
                                                $("#dobhide").hide();
                                            }
                                        }
                                    });

                                }

                                return {
                                    valid: checkSignupMobile(value),
                                    message: 'Mobile No. is not valid',

                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                }
            },
            user_signup_password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                    stringLength: {
                        message: 'Password should be more than 6 characters',
                        min: 6
                    }
                }
            },
            user_signup_cpassword: {
                validators: {
                    notEmpty: {
                        message: 'Repeat Password is required'
                    },
                    identical: {
                        field: 'user_signup_password',
                        message: 'The password and its repeat are not the same'
                    }
                }
            },
            accountty: {
                validators: {
                    notEmpty: {
                        message: 'User Type is required'
                    }
                }
            },
        }
    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var username = $('#txtName').val();
        var email1 = $('#user_signup_email').val();
        var dob1 = $('#user_signup_dob').val();
        var password1 = $('#user_signup_password').val();
        var password = encode64(password1);
        var dob = encode64(dob1);
        var email = encode64(email1);
        var mobileNo1 = $('#user_signup_mobile').val();
        var mobileNo = encode64(mobileNo1);
        var account_type = $('#accounttyId').val();

        var stuff = {
            'user_primary_name': username,
            'user_name': email,
            'user_date_of_birth': dob,
            'password': password,
            'mobileNo': mobileNo,
            'account_type': account_type
        };
        if ($('#agree').is(':checked')) {
            $('#disabledAnchorTag').addClass("disabledAnchor");
            $('#ResendOTPDisabledButton').removeClass("label-warning");

            $.ajax({
                type: "post",
                data: stuff,
                url: JS_BASE_URL + 'signin/verifymemberid',
                beforeSend: function () {
                    $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
                },
                success: function (response) {
                    var JSONArray = $.parseJSON(response);
                    var userOrgCode = $.trim(JSONArray.userOrgCode);
                    var message = $.trim(JSONArray.message);
                    $.ajax({
                        type: "post",
                        data: stuff,
                        url: JS_BASE_URL + 'signin/signup',
                        beforeSend: function () {
                            $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
                        },
                        success: function (response) {
                            var JSONArray = $.parseJSON(response);
                            var message = $.trim(JSONArray.message);

                            var userexist;
                            if (JSONArray.userexist) {
                                userexist = $.trim(JSONArray.userexist);
                            }
                            if ((message == 'error') && userexist == "exist") {
                                $('.mainLoader').remove();
                                bootbox.alert($.trim(JSONArray.error), function () {
                                    location.reload();
                                });
                            } else if (message == 'success' && userexist == 1) {
                                ga('send', 'event', { eventCategory: 'registration', eventAction: 'invester', eventLabel: 'membership' });
                                window.open(JS_BASE_URL + 'thank-you', '_self');
                            } else {
                                $('.show-signup-error').html('User already registered.');
                                $('.mainLoader').remove();
                            }
                        }
                    });
                }
            });
        } else {
            $("#termscon").css("display", "block");
        }
    });


    $("#agree").on("click", function () {
        if ($(this).is(':checked')) {
            $("#termscon").css("display", "none");
            $("#sign_up_button").removeAttr("disabled");
            $("#sign_up_button").removeClass("disabled");
        }
    });


    var bookIndex = 0;
    $('.addButton').click(function () {
        if (bookIndex < 0) {
            bookIndex = 0;
        } else {
            bookIndex++;
        }
        //		if (bookIndex < 5) {
        var $template = $('#transTemplate'),
            $clone = $template
                .clone()
                .removeClass('hide')
                .removeAttr('id')
                .attr('data-book-index', bookIndex)
                .attr("class", "remo")
                .insertBefore($template);
        $('#groupForm')
            .formValidation('addField', $clone.find('[name="date[]"]'))
            .formValidation('addField', $clone.find('[name="type[]"]'))
            .formValidation('addField', $clone.find('[name="amount[]"]'))
            .formValidation('addField', $clone.find('[name="units[]"]'))
            .formValidation('addField', $clone.find('[name="price[]"]'))
            .formValidation('addField', $clone.find('[name="openingBalance[]"]'))
            .formValidation('addField', $clone.find('[name="closingBalance[]"]'));

        $clone.find('[name="date[]"]').on('focus', function () {
            var $this = $(this);
            if (!$this.data('datepicker')) {
                $this.removeClass("hasDatepicker");
                $this.removeAttr('id');
                $this.datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0",
                    maxDate: new Date,
                    defaultDate: new Date(2000, 00, 01),
                    onSelect: function (date, inst) {
                        // Revalidate the field when choosing it from the datepicker
                        $('#groupForm').formValidation('revalidateField', $clone.find('[name="date[]"]'));
                    }
                });
                $this.datepicker("show");
            }
        });
        //	}
        //    else {
        //						$('#err-msg').css('display', 'inline-block');
        //				}
        $(".removeButton").unbind('click');
        $(".removeButton").click(function () {
            //var $row = $(this).parents('.form-group'),
            var $row = $(this).closest('tr'),
                index = $row.attr('data-book-index');
            $('#groupForm')
                .formValidation('removeField', $row.find('[name="date[]"]'))
                .formValidation('removeField', $row.find('[name="type[]"]'))
                .formValidation('removeField', $row.find('[name="amount[]"]'))
                .formValidation('removeField', $row.find('[name="price[]"]'))
                .formValidation('removeField', $row.find('[name="units[]"]'))
                .formValidation('removeField', $row.find('[name="openingBalance[]"]'))
                .formValidation('removeField', $row.find('[name="closingBalance[]"]'));
            $row.remove();
            bookIndex--;
        });
    });
    $('#groupForm').formValidation({
        maxDate: new Date,
        framework: 'bootstrap',
        row: {
            selector: 'td'
        },
        fields: {
            'date[]': {
                validators: {
                    notEmpty: {
                        message: 'Date is required'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    },
                    callback: {
                        message: 'Date is not valid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkDateRequired(value),
                                };
                            }
                        }

                    }
                }
            },
            'type[]': {
                validators: {
                    notEmpty: {
                        message: 'Type is required'
                    }
                }
            },
            'amount[]': {
                validators: {
                    notEmpty: {
                        message: 'Amount is required'
                    },
                    callback: {
                        message: 'Amount is not valid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkamnt(value),
                                };
                            }
                        }

                    },
                    stringLength: {
                        message: 'Please enter less than 16 digits',
                        max: function (value, validator, $field) {
                            return 21 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            'units[]': {
                validators: {
                    notEmpty: {
                        message: 'Units is required'
                    },
                    callback: {
                        message: 'Units is not valid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: amountValidationForDec(value),
                                };
                            }
                        }

                    },
                    stringLength: {
                        message: 'Please enter less than 16 digits',
                        max: function (value, validator, $field) {
                            return 21 - (value.match(/\r/g) || []).length;
                        }
                    },
                }
            },
            'price[]': {
                validators: {
                    notEmpty: {
                        message: 'Price is required'
                    },
                    callback: {
                        message: 'Price is not valid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: checkamnt(value),
                                };
                            }
                        }

                    },
                    stringLength: {
                        message: 'Please enter less than 16 digits',
                        max: function (value, validator, $field) {
                            return 21 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            'closingBalance[]': {
                validators: {
                    notEmpty: {
                        message: 'closing unit balance is required'
                    },
                    callback: {
                        message: 'closing unit balance is not valid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: checkamnt(value),
                                };
                            }
                        }

                    },
                    stringLength: {
                        message: 'Please enter less than 16 digits',
                        max: function (value, validator, $field) {
                            return 21 - (value.match(/\r/g) || []).length;
                        }
                    }

                }
            }
        }
    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var form = $("#groupForm").serialize();
        $.ajax({
            url: JS_BASE_URL + 'add-transaction',
            type: 'POST',
            data: form,
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (response) {

                //response = jQuery.parseJSON(response);
                //    $('#modal_transaction').modal('show');
                //  location.reload();
                $('#modal_transaction').modal('show');
                $('#succ_msg').css({
                    'display': 'block'
                });
                setTimeout("$('#succ_msg').fadeOut();", 1000);
                var fol_id = $('#folio_id_trans').val();
                var sch_id = $('#scheme_id_trans').val();
                var scheme = $('#trans-scheme').text();
                var folio_no = $('#folio-no-trans1').text();
                setnewtrns(folio_no, fol_id, scheme, sch_id);
                $('.remo').remove();
                $('.mainLoader').remove();
                $('#groupForm')[0].reset();
                $('#groupForm').formValidation('resetForm', true);
                //$('#droptype').val($("#droptype option:first").val());
                $('select#droptype>option[value="' + 1 + '"]').prop('selected', true);
                // $('#droptype').val();
            }
        });
        return false;
    }).find('[name="date[]"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: new Date,
        defaultDate: new Date,
        onSelect: function (date, inst) {
            // Revalidate the field when choosing it from the datepicker
            $('#groupForm').formValidation('revalidateField', 'date[]');
        }
    });
});
function resetInputValues() {
    $("input[name=radNation]").attr("checked", false);
}
// Validate Income details Tab
function clearIncomeValidationsMsg() {
    $('#ierror_1').css({
        display: 'none'
    });
    $('#ierror_11p').css({
        display: 'none'
    });
    $('#ierror_11').css({
        display: 'none'
    });
    $('#ierror_22').css({
        display: 'none'
    });
    $('#ierror_2').css({
        display: 'none'
    });
    $('#ierror_3').css({
        display: 'none'
    });
    $('#ierror_4').css({
        display: 'none'
    });
    $('#ierror_5').css({
        display: 'none'
    });
    $('#ierror_55p').css({
        display: 'none'
    });
    $('#ierror_55').css({
        display: 'none'
    });

    $('#ierror_1s').css({
        display: 'none'
    });

    $('#ierror_2s').css({
        display: 'none'
    });
    $('#ierror_5s').css({
        display: 'none'
    });
}


function checkNameString(val) {
    var nameRe = /^[a-zA-Z ]*$/;
    if (nameRe.test(val)) {
        return true;
    } else {
        return false;
    }
}



$(document).ready(function () {
    // set auto fill email and mobile from basic details
    setBasicEmailMobileInAddress();

    // show/hide investment frequency amount
    iFrequencyAmount();
    $('input[type=radio][name=investment_type]').change(function () {
        iFrequencyAmount();
    });

    $("#addresstab").on('click', function () {
        setBasicEmailMobileInAddress();
    });


    // When a tab is clicked, cursor should come to first editable field
    jQuery.fn.putCursorAtEnd = function () {
        return this.each(function () {
            $(this).focus();
            // If this function exists...
            if (this.setSelectionRange) {
                // ... then use it (Doesn't work in IE)
                // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
                var len = $(this).val().length * 2;
                this.setSelectionRange(len, len);
            } else {
                // ... otherwise replace the contents with itself
                // (Doesn't work in Google Chrome)
                $(this).val($(this).val());
            }
            // Scroll to the bottom, in case we're in a tall textarea
            // (Necessary for Firefox and Google Chrome)
            this.scrollTop = 999999;
        });
    };


    setTimeout(function () {
        $("#txtName").putCursorAtEnd();
    }, 1000);

    $("#basicdetailtab").on('click', function () {
        setTimeout(function () {
            $("#txtName").putCursorAtEnd();
        }, 1000);

    });
    $("#addresstab").on('click', function () {
        setTimeout(function () {
            $("#residence_address").focus();
        }, 1000);

    });
    $("#banktab").on('click', function () {
        setTimeout(function () {
            $("#radAcTypeprimary").focus();
        }, 1000);

    });
    $("#kyctab").on('click', function () {
        setTimeout(function () {
            $("#indianChk").focus();
        }, 1000);

    });
    $("#incometab").on('click', function () {
        setTimeout(function () {
            $("#radIdProofs").focus();
        }, 1000);

    });
    $("#taxtab").on('click', function () {
        setTimeout(function () {
            $("#city_of_birth").focus();
        }, 1000);

    });
    $("#nomineetab").on('click', function () {
        setTimeout(function () {
            $("#nominee_1_name").focus();
        }, 1000);

    });
    $("#documenttab").on('click', function () {
        setTimeout(function () {
            $("#idproof_select").focus();
        }, 1000);

    });
    $("#foliotab").on('click', function () {
        setTimeout(function () {
            $("#txtAccntnumber11").focus();
        }, 1000);

    });


});

function setBasicEmailMobileInAddress() {
    $("#email_id").val($("#form-field-mask-2pemail").val());
    $("#mobile_no").val($("#form-field-mask-2").val());
}

function iFrequencyAmount() {
    var investmentType = $("input[name='investment_type']:checked").val();
    if (investmentType == "lumpsum") {
        $("#iFrequenyAmt").hide();
    } else {
        $("#iFrequenyAmt").show();
    }
}


function resetReg() {
    $('.fv-icon-no-label').removeClass('glyphicon-ok');
    $('.fv-icon-no-label').removeClass('glyphicon-ok');
    $("#form-signup-new").data('formValidation').resetForm();
}

function checkEmail(val) {
    var emailRe = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var phoneRe = /^[0-9]{10}$/;
    var strRe = /^[a-zA-Z\s.-_]+$/;
    if (emailRe.test(val) || phoneRe.test(val) || strRe.test(val)) {

        return true;
    } else {
        return false;
    }
}

function checkSignupEmail(val) {
    var emailRe = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailRe.test(val)) {
        return true;
    } else {
        return false;
    }
}
function checkSignupMobile(val) {
    var phoneRe = /^[0-9]{10}$/;
    if (phoneRe.test(val)) {
        return true;
    } else {
        return false;
    }
}

function checkEmailfreeportfolio(val) {
    var emailRe = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailRe.test(val)) {
        return true;
    } else {
        return false;
    }
}


function checkEmailactiveval(val) {
    //$("#sign_in_button").prop('disabled', true);
    var emailRe = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var phoneRe = /^[0-9]{10}$/;
    if (emailRe.test(val) || phoneRe.test(val)) {

        return true;
        //   checkEmailactivecheckcount(val);
        // var activestatus = $('#acid').val();
        // alert(activestatus);

    } else {
        var activestatus = $('#acid').val("");
        return false;
    }
}


function checkEmailactivecheckcount(val) {
    $.ajax({
        type: 'post', data: { 'emailidmob': val },
        url: JS_BASE_URL + 'emailmobilecheck',
        success: function (result) {
            $('#acid').val(result);
            //var activestatus = $('#acid').val();
            if (result != '') {
                // $('.show-login-error').hide();
                //$("#sign_in_button").show();
                // $("#sign_in_button3").hide();
                //$("#sign_in_button").prop('disabled', false);
                return true;
            } else {
                // $("#sign_in_button").hide();
                // $("#sign_in_button3").show();
                //$('#activeDeactiveFlag').val("2");
                $('.show-login-error').html('Account has been disabled!');
                $('.show-login-error').css('font-size', '100% !important');
                $('.show-login-error').css('color', '#CA0000');
                //$("#sign_in_button").prop('disabled', true); 
                return false;
            }
        }
    });

}

function checkmobile(val) {
    var phoneRe = /^[0-9]{10}$/;
    if (phoneRe.test(val)) {
        return true;
    } else {
        return false;
    }
}

function checkEmailfreeportfolio(val) {
    var emailRe = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailRe.test(val)) {
        return true;
    } else {
        return false;
    }
}

function chkSpecChars(value) {
    if (/^[a-zA-Z\s.-]+$/.test(value) === false) {
        return false;
    } else {
        return true;
    }
}

function chkPan(value) {
    if (/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/.test(value)) {
        return true;
    } else {
        return false;
    }
}
function panuniqchek(value, successCallback) {
    var flag = false;
    $.ajax({
        type: 'post',
        data: { 'pan_number': value },
        beforeSend: function () {
            $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
        },
        url: JS_BASE_URL + 'user/uniquepan',
        success: function (result) {
            var res = jQuery.parseJSON(result);
            if (res.status == 'success') {
                if (res.flag == 'Y') {
                    $(".mainLoader").remove();
                    flag = true;
                    successCallback(flag);
                } else {
                    $(".mainLoader").remove();
                    flag = false;
                    successCallback(flag);
                }

            } else {
                flag = false;
                successCallback(flag);
            }


        }
    });

}

function amountvalidation(value, successCallback) {
    var flag = false;
    if (!parseFloat(value)) {
        flag = "notvalid";
    } else if (value.indexOf(".") > 10 || isNaN(value) || parseFloat(value) < 1) {
        flag = "invalidamount";
    } else if ((value.indexOf(".") != -1) && (value.substring(value.indexOf(".")).length > 3)) {
        flag = "decimalamount";
    } else {
        flag = "1";
    }
    return flag;
}

function chkaadhar(value) {
    if (/^([0-9]{12})$/.test(value)) {
        return true;
    } else {
        return false;
    }
}

function checkIfnull(value) {
    if (value != "") {
        return true;
    } else {
        return false;
    }

}

function enableSubmit(form) {
    //var val= $("#"+id).css("height");
    //if(val=="false"){
    //$("#" + form).data('formValidation').resetForm();
    //}
    $('#' + form).click();
    return true;
}

function chkalphaNumeric(value) {
    var regx = /^[A-Za-z0-9]+$/;
    if (regx.test(value)) {
        return true;
    } else {
        return false;
    }

}

function getIfsc(id) {
    $("#errorifsc_20").css("display", "none");

    $('#ifscbankstates').find('option:gt(0)').remove();
    $('#ifsccity').find('option:gt(0)').remove();
    $('#ifscbranch').find('option:gt(0)').remove();

    $("#ifscmodal").modal({
        show: true
    });
    getBanks();
    $("#ifscid").val(id);
}

function getBanks() {
    $.ajax({
        url: JS_BASE_URL + 'bank',
        //data: {},
        dataType: "json",
        type: 'Post',
        success: function (data) {
            var items = '<option selected="selected" value="">--Select Bank--</option>';
            $.each(data, function (i, item) {
                items += "<option value=\"" + item.bank + "\">" + item.bank + "</option>";
            });
            $("#ifscallbanks").html(items);
        }
    });
}

function getStates(bank) {
    $.ajax({
        url: JS_BASE_URL + 'state',
        data: {
            bank: bank
        },
        dataType: "json",
        type: 'Post',
        success: function (data) {
            var items = '<option selected="selected" value="">--Select State--</option>';
            $.each(data, function (i, item) {
                items += "<option value=\"" + item.state + "\">" + item.state + "</option>";
            });
            $("#ifscbankstates").html(items);
            $("#ifscbankstates").removeAttr("disabled");
        }
    });
}

function getCity(state) {
    var bank = $("#ifscallbanks").val();
    $.ajax({
        url: JS_BASE_URL + 'city',
        data: {
            bank: bank,
            state: state
        },
        dataType: "json",
        type: 'Post',
        success: function (data) {
            var items = '<option selected="selected" value="">--Select City--</option>';
            $.each(data, function (i, item) {
                items += "<option value=\"" + item.city + "\">" + item.city + "</option>";
            });
            $("#ifsccity").html(items);
            $("#ifsccity").removeAttr("disabled");
        }
    });

}

function getBranch(city) {
    var bank = $("#ifscallbanks").val();
    var state = $("#ifscbankstates").val();
    $.ajax({
        url: JS_BASE_URL + 'branch',
        data: {
            bank: bank,
            state: state,
            city: city
        },
        dataType: "json",
        type: 'Post',
        success: function (data) {
            var items = '<option selected="selected" value="">--Select Branch--</option>';
            $.each(data, function (i, item) {
                items += "<option value=\"" + item.branch + "\">" + item.branch + "</option>";
            });
            $("#ifscbranch").html(items);
            $("#ifscbranch").removeAttr("disabled");
        }
    });

}

function getIfscDetails() {
    var val = $("#ifscid").val();
    $("#ifscid_" + val).val('');
    $("#ifscid_" + val).attr('value', '');
    $("#txtResAdd_" + val).html('');
    var inputName = $('#txtIfsc' + val).attr('name');

    var bank = $("#ifscallbanks").val();
    var state = $("#ifscbankstates").val();
    var city = $("#ifsccity").val();
    var branch = $("#ifscbranch").val();
    if ((bank != "") && (state != "") && (city != "") && (branch != "")) {
        $.ajax({
            url: JS_BASE_URL + 'ifsc-detail',
            data: {
                bank: bank,
                state: state,
                city: city,
                branch: branch
            },
            dataType: "json",
            type: 'Post',
            success: function (data) {
                var id = $("#ifscid").val();
                var html = "";
                $.each(data, function (i, item) {
                    html += '<span> <b>Bank Name : </b>' + item.bank + '</span><br>';
                    html += '<span> <b>State : </b>' + item.state + '</span><br>';
                    html += '<span> <b>City : </b>' + item.city + '</span><br>';
                    html += '<span> <b>Branch Name : </b>' + item.branch + '</span><br>';
                    html += '<span> <b>IFSC Code : </b>' + item.ifsc + '</span><br>';
                    html += '<span> <b>MICR Code: </b>' + item.micr + '</span><br>';
                    html += '<span> <b>Address : </b>' + item.address + '</span><br>';
                    $("#txtResAdd_" + id).html("");
                    $("#txtResAdd_" + id).html(html);
                    $("#ifscid_" + id).val(item.id);
                    $("#txtIfsc" + id).val(item.ifsc);
                });
                setTimeout(function () {
                    $('#sample-form-bankdetail').formValidation('revalidateField', inputName);
                }, 200);
                $("#ifscmodal").modal('hide');

            }
        });

    } else {
        $("#errorifsc_20").css("display", "block");
    }

}

function getAutocomplete(id, val) {

    $("#ifscid_" + val).val('');
    $("#ifscid_" + val).attr('value', '');
    $("#txtResAdd_" + val).html('');
    var inputName = $('#' + id).attr('name');

    $('#' + id).autocomplete({
        autoFocus: true,
        source: function (request, response) {

            $.ajax({
                url: JS_BASE_URL + 'ifsc',
                data: {
                    term: request.term
                },
                dataType: "json",
                type: 'GET',
                beforeSend: function () {
                    $('.checkifsc').prop('disabled', 'disabled');
                },
                success: function (data) {

                    response($.map(data, function (item) {
                        return {
                            value: item.value,
                            label: item.ifsc_code,
                            id: item.address,
                            ifsc: item.id,
                            micr: item.micr,
                            bank: item.bank,
                            state: item.state,
                            city: item.city,
                            branch: item.branch,
                        };
                    }))

                }
            })
        },
        search: function () {

        },
        focus: function () { },
        select: function (event, ui) {
            $(this).val(ui.item.label);
            $("#ifscid_" + val).val(ui.item.ifsc);
            $("#s_primary_ac_ifscid").val(ui.item.ifsc);
            $('.checkifsc').removeAttr('disabled');
            var html = "";
            html += '<span> <b>Bank Name : </b>' + ui.item.bank + '</span><br>';
            html += '<span> <b>State : </b>' + ui.item.state + '</span><br>';
            html += '<span> <b>City : </b>' + ui.item.city + '</span><br>';
            html += '<span> <b>Branch Name : </b>' + ui.item.branch + '</span><br>';
            html += '<span> <b>IFSC Code : </b>' + ui.item.label + '</span><br>';
            html += '<span> <b>MICR Code : </b>' + ui.item.micr + '</span><br>';
            html += '<span> <b>Address : </b>' + ui.item.id + '</span><br>';
            $("#txtResAdd_" + val).html(html);
            $("#txtResAddj_1").html(html);
            setTimeout(function () {
                $('#sample-form-bankdetail').formValidation('revalidateField', inputName);

            }, 200);



        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        var inner_html = "";
        if (item != "") {
            inner_html = '<div class="image_title">' + item.value + '</div></div></a>';
        } else {
            inner_html = '<div class="image">No Records Find</div>';

        }
        return $("<li></li>")
            .data("ui-autocomplete-item", item)
            .append(inner_html)
            .appendTo(ul);

    };
}

function setKYCdetailName() {
    var dateText = $("#date_picker").attr('value');
    var newdate = dateText.split("-").reverse().join("-");
    var birthdate = new Date(newdate);
    var cur = new Date();
    var diff = cur - birthdate;
    var age = Math.floor(diff / 31536000000);
    if (age < 18) {
        var nameValue = $("#txtGuardian").val();
        $("#nameonpan").attr('value', nameValue);
    } else {
        var nameValue = $("#txtName").val();
        $("#nameonpan").attr('value', nameValue);
    }

}
$(window).load(function () {
    if ($("#date_picker").length > 0) {
        setKYCdetailName();
    }
});

function enablememberDetail() {
    $('#sample-form-member').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        //        icon: {
        //            valid: 'glyphicon glyphicon-ok',
        //            invalid: 'glyphicon glyphicon-remove',
        //            validating: 'glyphicon glyphicon-refresh'
        //        },
        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Name should not have special character and numbers',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Name must be less than 30 characters',
                        max: function (value, validator, $field) {
                            return 30 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            fathername: {
                validators: {
                    notEmpty: {
                        message: 'Father / Spouse Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Father / Spouse Name should not have special character and numbers',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Father / Spouse Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            user_dob: {
                validators: {
                    excluded: false,
                    notEmpty: {
                        message: 'Date Of birth is required'
                    },
                    callback: {
                        message: 'Date of Birth is invalid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkDate(value),
                                };
                            }
                        }

                    }
                }

            },
            primary_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Primary mobile number Is Required!'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: existmobile(value),
                                };
                            }
                        }
                    },
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                }
            },
            alternate_mobile: {
                validators: {
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                    different: {
                        field: 'primary_mobile',
                        message: 'The primary and its alternate mobile no. should not be same'
                    }

                }
            },
            primary_email: {
                validators: {
                    notEmpty: {
                        message: 'Primary email Is required!'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: existemail(value),
                                };
                            }
                        }
                    },
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                }
            },
            alternate_email: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                    different: {
                        field: 'primary_email',
                        message: 'The primary and its alternate email should not be same'
                    }
                }
            },
        }
    }).on('success.form.fv', function (e) {

        // Prevent form submission
        e.preventDefault();
        var $form = $(e.target), // Form instance
            // Get the clicked button
            $button = $form.data('formValidation').getSubmitButton();
        $.ajax({
            url: JS_BASE_URL + 'member',
            type: 'POST',
            data: $("#sample-form-member").serialize(),
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (result) {
                if (result = 'true') {
                    location.href = 'profile';
                }
            },
        });
    });
}

function enablememberDetailPan() {
    $('#sample-form-member-pan').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        //        icon: {
        //            valid: 'glyphicon glyphicon-ok',
        //            invalid: 'glyphicon glyphicon-remove',
        //            validating: 'glyphicon glyphicon-refresh'
        //        },
        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Name should not have special character and numbers',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Name must be less than 30 characters',
                        max: function (value, validator, $field) {
                            return 30 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            fathername: {
                validators: {
                    notEmpty: {
                        message: 'Father / Spouse Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Father / Spouse Name should not have special character and numbers',
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Father / Spouse Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            user_dob: {
                validators: {
                    excluded: false,
                    notEmpty: {
                        message: 'Date Of birth is required'
                    },
                    callback: {
                        message: 'Date of Birth is invalid',
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: checkDate(value),
                                };
                            }
                        }

                    }
                }

            },
            primary_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Primary mobile number Is Required!'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: existmobile(value),
                                };
                            }
                        }
                    },
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                }
            },
            alternate_mobile: {
                validators: {
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                    different: {
                        field: 'primary_mobile',
                        message: 'The primary and its alternate mobile no. should not be same'
                    }

                }
            },
            primary_email: {
                validators: {
                    notEmpty: {
                        message: 'Primary email Is required!'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: existemail(value),
                                };
                            }
                        }
                    },
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                }
            },
            alternate_email: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                    different: {
                        field: 'primary_email',
                        message: 'The primary and its alternate email should not be same'
                    }
                }
            },

            pan_number: {
                validators: {
                    notEmpty: {
                        message: 'PAN is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "" && $("#sample-form-basicdetail [name='aadhar_number']").val() == '') {
                                return {
                                    valid: false,
                                    message: "You must enter either pan number or aadhar number"
                                };
                            } else if (value != "") {
                                if (chkPan(value) == false && $('#pekrn').val() != '1') {
                                    return {
                                        valid: false,
                                        message: 'PAN number check failed'
                                    };
                                } else {
                                    $('#pekrn').val('0');
                                    return true;
                                }
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },
        }
    }).on('success.form.fv', function (e) {

        // Prevent form submission
        e.preventDefault();
        var $form = $(e.target), // Form instance
            // Get the clicked button
            $button = $form.data('formValidation').getSubmitButton();
        $.ajax({
            url: JS_BASE_URL + 'cams-upload-addmember',
            type: 'POST',
            data: $("#sample-form-member-pan").serialize(),
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (result) {
                // alert("result"+result);
                var obj = jQuery.parseJSON(result);
                if (obj.success != '') {
                    $("#savesucessmessage").html("");
                    $("#savesucessmessage").html("Saved successfully");
                    $("#savesucessmessage").show();
                    $('.mainLoader').remove();
                    var hiddenpannumber = $("#hiddenpannumber").val();
                    var splitCommaSepPan = hiddenpannumber.split(",");
                    if (splitCommaSepPan.length == 1) {
                        setTimeout(function () {
                            $(".close").click();
                        }, 2000);
                    }
                    return false;
                }
            },
        });
    });
}

function revalidation(form_id, field_name, type) {
    if (type !== 'statement') {
        $('#' + form_id + '').formValidation('revalidateField', '' + field_name + '');
    }
    var refDob = $('#' + field_name + ''),
        targetDob = refDob.next(),
        dateDob = targetDob.find('select:nth-child(1)');
    setTimeout(function () {
        dateDob.find('option:nth-child(1)').text('DD');
    });

}
/* Kuldeep KD Bagwari Added this cod */

function revalidationadmin() {
    $('#message').html('');
    var day = $(".day").val();
    var month = $(".month").val();
    var year = $(".year").val();
    if (day != '' && month != '' && year != '') {
        var frmDate = $('#fromStatement').val();
        $('#searchreodrds').prop("disabled", false);
        $('#message').html('');
        $('#messagetodate').html('');

    } else {
        $('#message').html('<div style="alignment-adjust:central; color:red">Please Select From Date</div>');
        $('#searchreodrds').prop("disabled", true);
        return false;
    }
    var toDate = $('#toStatement').val();
    if ((Date.parse(frmDate) > Date.parse(toDate))) {
        $('#messagetodate').html('');
        $('#message').html('<div style="alignment-adjust:central; color:red">To Date should be greater than From Date</div>');
        $('#searchreodrds').prop("disabled", true);
        return false;
    }
    $('#searchreodrds').prop("disabled", false);
}
function revalidationadminexicutin() {
    $('#message').html('');
    var day = $(".day").val();
    var month = $(".month").val();
    var year = $(".year").val();
    if (day != '' && month != '' && year != '') {
        var frmDate = $('#fromStatement').val();
        var currentdate = $('#currentdate').val();
        if (frmDate <= currentdate) {
            $('#searchreodrds').prop("disabled", false);
            $('#message').html('');
        } else {
            $('#message').html("<div style='alignment-adjust:central; color:red'>Date should not be greater than current Date</div>");
            $('#searchreodrds').prop("disabled", true);
            return false;
        }


    } else {
        $('#message').html('<div style="alignment-adjust:central; color:red">Please Select From Date</div>');
        $('#searchreodrds').prop("disabled", true);
        return false;
    }
    var toDate = $('#toStatement').val();
    if ((Date.parse(frmDate) > Date.parse(toDate))) {
        $('#message').html('<div style="alignment-adjust:central; color:red">To Date should be greater than From Date</div>');
        $('#searchreodrds').prop("disabled", true);
        return false;
    }
    $('#searchreodrds').prop("disabled", false);
}










function revalidationadmintodate() {
    var frmDate = $('#fromStatement').val();
    if (frmDate != '') {

        var day = $(".day").val();
        var month = $(".month").val();
        var year = $(".year").val();
        if (day != '' && month != '' && year != '') {
            var toDate = $('#toStatement').val();
            $("#message").html('');
            $('#messagetodate').html('');
            $('#searchreodrds').prop("disabled", false);

        } else {
            $('#messagetodate').html('<div style="alignment-adjust:central; color:red">Please Select To Date</div>');
            $('#searchreodrds').prop("disabled", true);

            return false;
        }
    }
    if ((Date.parse(frmDate) > Date.parse(toDate))) {
        $("#message").html('');
        $('#messagetodate').html('<div style="alignment-adjust:central; color:red">To Date should be greater than From Date</div>');
        $('#searchreodrds').prop("disabled", true);
        return false;
    }
    $('#searchreodrds').prop("disabled", false);

}





/* End */
$(function () {
    $('#date_picker').on('change', function () {
        var form_id = $(this).closest('form').attr('id');
        var field_name = $(this).attr('name');
        $('#' + form_id + '').formValidation('revalidateField', '' + field_name + '');
        if ($("#date_picker").length > 0) {
            var newdate = $('#date_picker').val().split("-").reverse().join("-");
            var birthdate = new Date(newdate);
            var cur = new Date();
            var diff = cur - birthdate;
            var age = Math.floor(diff / 31536000000);
            if (age < 18) {
                $("#faq-list-3").css("display", "block");
                $("#nomineetab").css("display", "none");

                $(".minner").css("display", "none");
                expandGuardian();
                $('#sample-form-basicdetail').formValidation('enableFieldValidators', 'gtxtDob', true);
            } else {
                $("#faq-list-3").css("display", "none");
                $("#nomineetab").css("display", "block");
                $(".minner").css("display", "block");
                $('#sample-form-basicdetail').formValidation('enableFieldValidators', 'gtxtDob', false);
            }
        }
    });

    if ($("#date_picker").length > 0) {
        var newdate = $('#date_picker').val().split("-").reverse().join("-");

        var birthdate = new Date(newdate);
        var cur = new Date();
        var diff = cur - birthdate;
        var age = Math.floor(diff / 31536000000);
        if (age < 18) {
            $("#faq-list-3").css("display", "block");
            $("#nomineetab").css("display", "none");

            $(".minner").css("display", "none");
            expandGuardian();
            $('#sample-form-basicdetail').formValidation('enableFieldValidators', 'gtxtDob', true);
        } else {
            $("#faq-list-3").css("display", "none");
            $("#nomineetab").css("display", "block");
            $(".minner").css("display", "block");
            $('#sample-form-basicdetail').formValidation('enableFieldValidators', 'gtxtDob', false);
        }

    }
});

function valdate() {
    $('#groupForm').formValidation('revalidateField', 'date[]');
}

function checkamnt(val) {
    var emailRe = /^[0-9]{0,16}(\.[0-9]{1,4})?$/;
    if (emailRe.test(val)) {
        return true;
    } else {
        return false;
    }
}

function amountValidationForDec(val) {
    var emailRe = /^[0-9]{0,16}(\.[0-9]{1,4})?$/;
    if (emailRe.test(val)) {
        return true;
    } else {
        return false;
    }
}

function checkDate(val) {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    today = mm + '-' + dd + '-' + yyyy;
    aadate = val.split('-');
    aatoday = today.split('-');
    ew_start_date = new Date(aadate[2], aadate[1], aadate[0]);
    pw_date = new Date(aatoday[2], aatoday[0], aatoday[1]);
    if (new Date(ew_start_date) > new Date(pw_date)) {
        return false;
    } else {
        return true;
    }
}

function checkDateRequired(val) {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 2; //January is 0!

    var yyyy = today.getFullYear();
    today = mm + '-' + dd + '-' + yyyy;
    aadate = val.split('-');
    aatoday = today.split('-');
    ew_start_date = new Date(aadate[2], aadate[1], aadate[0]);
    pw_date = new Date(aatoday[2], aatoday[0], aatoday[1]);
    if (new Date(ew_start_date) > new Date(pw_date)) {
        return false;
    } else {
        return true;
    }
}

function setnewtrns(folio, folio_id, scheme, scheme_id) {
    var form = {
        'folio_id': folio_id
    };
    $.ajax({
        url: JS_BASE_URL + 'transactions',
        type: 'POST',
        data: form,
        beforeSend: function () {
            $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
        },
        success: function (response) {

            result = jQuery.parseJSON(response);
            //$('#simple-table tbody').html('');
            $(".TRremove").remove();
            $('.mainLoader').remove();
            var html = '';
            for (i = 0; i < result.length; i++) {
                if (result[i].transaction_date) {
                    var vals = result[i].transaction_date.split('-');
                    var dateformat = vals[2] + '-' + vals[1] + '-' + vals[0];
                } else {
                    var dateformat = 'not available';
                }
                var amountformat = '';
                if (result[i].amount) {
                    var amountformat = parseFloat(result[i].amount).toFixed(2);
                } else {
                    var amountformat = "not available";
                }
                var amount_name = '';
                if (result[i].name) {
                    var amount_name = result[i].name;
                } else {
                    var amount_name = "not available";
                }
                var amount_units = '';
                if (result[i].units) {
                    var amount_units = parseFloat(result[i].units).toFixed(4);
                } else {
                    var amount_units = "not available";
                }
                var amt_nav_price = '';
                if (result[i].nav_price) {
                    var amt_nav_price = parseFloat(result[i].nav_price).toFixed(4);
                } else {
                    var amt_nav_price = "not available";
                }
                var amt_close = ''
                if (result[i].closing_unit_balance) {
                    var amt_close = parseFloat(result[i].closing_unit_balance).toFixed(4);
                } else {
                    var amt_close = "not available";
                }
                var transaction_desc = '';
                if (result[i].transaction_desc) {
                    var transaction_desc = result[i].transaction_desc;
                }
                //                                 var cdate ='';
                //                                if (result[i].transaction_desc) {
                //                                    var cdate = result[i].created_by +  '\n' + result[i].created_at;
                //                                } 
                //                                 var udate ='';
                //                                if (result[i].transaction_desc) {
                //                                    var udate = result[i].updated_by + '\n' + result[i].updated_at;
                //                                }
                var cdate = '';
                var cname = 'not available';
                var currentdate = 'not available';
                if (result[i].created_by) {
                    var cname = result[i].created_by;
                }
                if (result[i].created_at) {
                    var currentdate = result[i].created_at;
                }
                var curdate = '';
                if (cname == 'not available' && currentdate == 'not available') {
                    var curdate = 'not available';
                } else {
                    var curdate = cname + ' / ' + '\n' + currentdate;
                }


                var udate = '';
                var uname = 'not available';
                var updatedate = 'not available';
                if (result[i].updated_by) {
                    var uname = result[i].updated_by;
                }
                if (result[i].updated_at) {
                    var updatedate = result[i].updated_at;
                }
                if (uname == 'not available' && updatedate == 'not available') {
                    var udate = 'not available';
                } else {
                    var udate = uname + ' / ' + '\n' + updatedate;
                }



                var roleiduser = $("#roleiduser").val();
                html = html + '<tr class="TRremove" id="transno_' + result[i].id + '">';
                html = html + '<td class="">' + dateformat + '</td>';
                html = html + '<td  class="">' + amount_name + '</td>';
                html = html + '<td  class="">' + transaction_desc + '</td>';
                html = html + '<td  class="amountRight">' + format(amountformat) + '</td>';
                html = html + '<td  class="amountRight">' + format(amount_units) + '</td>';
                html = html + '<td class="amountRight">' + format(amt_nav_price) + '</td>';
                html = html + '<td  class="amountRight">' + format(amt_close) + '</td>';
                if (roleiduser == 1) {
                    // html = html + '<td  class="">' +  curdate + '</td>';
                    html = html + '<td  class="">' + udate + '</td>';
                }
                html = html + '<td style="text-align:center;padding-top:14px;"><a return false><i class="ace-icon fa fa-trash" onclick="deleteTrans(' + result[i].id + ')"></i></a></td>';
                html = html + '</tr>';
            }

            //  $("#remove_tr").find("tr:gt(1):not(:last)").remove();
            $('#simple-table tbody tr:first').before(html);
        }
    });
}

function format(num) {
    if (num == "not available") {
        return num;
    } else {
        var n = num.toString(),
            p = n.indexOf('.');
        return n.replace(/\d(?=(?:\d{3})+(?:\.|$))/g, function ($0, i) {
            return p < 0 || i < p ? ($0 + ',') : $0;
        });
    }

}
function encode64(input) {
    var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;
    do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);
        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;
        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }
        output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
    } while (i < input.length);
    return output;
}
function join_account() {


    $('#sample-form-jointaccount').formValidation('destroy');

    $('#sample-form-jointaccount').formValidation({
        framework: 'bootstrap',

        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            "account-type": {
                validators: {
                    notEmpty: {
                        message: 'Account Type is required'
                    },
                }
            },
            primary_account: {
                validators: {
                    notEmpty: {
                        message: 'Primary holder is required'
                    }
                }
            },
            secondary_account: {
                validators: {
                    notEmpty: {
                        message: 'Secondary holder is required'
                    },
                }
            }
        }
    }).on('success.form.fv', function (e) {
        e.preventDefault();
        //var accounttype = document.getElementById("account_type").value;

        var accounttype = $('input[name=account-type]:checked').val();

        var primary = document.getElementById("primary_account").value;
        var secondary = document.getElementById("secondary_account").value;
        var dataString = 'primaryaccount=' + primary + '&secondaryaccount=' + secondary + '&jointaccounttype=' + accounttype;
        $.ajax({
            type: "POST",
            url: JS_BASE_URL + 'dashboard/jointaccount',
            data: dataString,

            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (response) {
                //console.log(response); return false;
                var prim = "Primary Holder's basic details is not filled !";

                var secd = "Secondary Holder's basic details is not filled !";
                $('.mainLoader').remove();
                if ($.trim(response) == -1) {

                    $('#form_errorformonsubmitjoint').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-times red"></i> You already have joint account!');
                    $('.errorformonsubmit2').css("display", "block");



                } else if ($.trim(response) == 'na') {
                    $('#form_errorformonsubmitjoint').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-times red"></i> You are not eligible for joint account!');
                    $('.errorformonsubmit2').css("display", "block");



                } else if ($.trim(response) == 'pn') {
                    $('#form_errorformonsubmitjoint').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-times red"></i> ' + prim);
                    $('.errorformonsubmit2').css("display", "block");



                } else if ($.trim(response) == 'sn') {
                    $('#form_errorformonsubmitjoint').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-times red"></i> ' + secd);
                    $('.errorformonsubmit2').css("display", "block");


                } else {

                    //setusercookie(response);
                    window.location.href = JS_BASE_URL + "profile";
                }
            }
        });

    });

}
function joint_basic() {
    var mesg = "You must enter either pan number or aadhar number";

    $('#samplesecondary-form-basicdetail').formValidation({
        framework: 'bootstrap',

        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            p_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Name must be less than 65 characters',
                        max: function (value, validator, $field) {
                            return 65 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            s_name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Name must be less than 65 characters',
                        max: function (value, validator, $field) {
                            return 65 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            p_fathername: {
                validators: {
                    notEmpty: {
                        message: 'Father / Spouse Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Father / Spouse Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Father / Spouse Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },

            s_fathername: {
                validators: {
                    notEmpty: {
                        message: 'Father / Spouse Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Father / Spouse Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Father / Spouse Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            p_mothername: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Mother Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Mother Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },

            s_mothername: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                //                                console.log($field)
                                return {
                                    valid: chkSpecChars(value),
                                    message: 'Mother Name should not have special character and numbers',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                    stringLength: {
                        message: 'Mother Name must be less than 100 characters',
                        max: function (value, validator, $field) {
                            return 100 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            p_user_dob: {
                excluded: false,
                validators: {
                    notEmpty: {
                        message: 'Date Of birth is required'
                    },
                }
            },
            s_user_dob: {
                excluded: false,
                validators: {
                    notEmpty: {
                        message: 'Date Of birth is required'
                    },
                }
            },
            p_primary_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Primary mobile number Is Required!'
                    },
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                }
            },
            s_primary_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Primary mobile number Is Required!'
                    },
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                }
            },
            p_alternate_mobile: {
                validators: {
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                    different: {
                        field: 'primary_mobile',
                        message: 'The primary and its alternate mobile no. should not be same'
                    }

                }
            },
            s_alternate_mobile: {
                validators: {
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                    different: {
                        field: 'primary_mobile',
                        message: 'The primary and its alternate mobile no. should not be same'
                    }

                }
            },
            p_primary_email: {
                validators: {
                    notEmpty: {
                        message: 'Primary email Is required!'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                }
            },
            s_primary_email: {
                validators: {
                    notEmpty: {
                        message: 'Primary email Is required!'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                }
            },
            p_alternate_email: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                    different: {
                        field: 'primary_email',
                        message: 'The primary and its alternate email should not be same'
                    }
                }
            },
            s_alternate_email: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                    different: {
                        field: 'primary_email',
                        message: 'The primary and its alternate email should not be same'
                    }
                }
            },

            p_pan_number: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "" && $("#samplesecondary-form-basicdetail [name='p_aadhar_number']").val() == '') {
                                return {
                                    valid: false,
                                    message: "You must enter either pan number or aadhar number"
                                };
                            } else if (value != "") {
                                if (chkPan(value) == false && $('#pekrn').val() != '1') {
                                    return {
                                        valid: false,
                                        message: 'PAN number check failed, Is it a PEKRN? - <a href="javascript:void(0);" class="js-pekrn">Yes its PEKRN</a>'
                                    };
                                } else {

                                    $('#pekrn').val('0');
                                    return true;
                                }
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },

            s_pan_number: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "" && $("#samplesecondary-form-basicdetail [name='s_aadhar_number']").val() == '') {
                                return {
                                    valid: false,
                                    message: "You must enter either pan number or aadhar number"
                                };
                            } else if (value != "") {
                                if (chkPan(value) == false && $('#pekrn').val() != '1') {
                                    return {
                                        valid: false,
                                        message: 'PAN number check failed, Is it a PEKRN? - <a href="javascript:void(0);" class="js-pekrn">Yes its PEKRN</a>'
                                    };
                                } else {

                                    $('#pekrn').val('0');
                                    return true;
                                }
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },

            p_aadhar_number: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "" && $("#samplesecondary-form-basicdetail [name='p_pan_number']").val() == '') {
                                return {
                                    valid: false,
                                    message: "You must enter either pan number or aadhar number"
                                };
                            } else if (value != "" && chkaadhar(value) == false) {
                                return {
                                    valid: false,
                                    message: "Not a valid Aadhar number"
                                };
                            } else {
                                return true;
                            }
                            return false;
                        }
                    }
                }
            },

            s_aadhar_number: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "" && $("#samplesecondary-form-basicdetail [name='s_pan_number']").val() == '') {
                                return {
                                    valid: false,
                                    message: "You must enter either pan number or aadhar number"
                                };
                            } else if (value != "" && chkaadhar(value) == false) {
                                return {
                                    valid: false,
                                    message: "Not a valid Aadhar number"
                                };
                            } else {
                                return true;
                            }
                            return false;
                        }
                    }
                }
            }
        }
    })

}

//added code for goalbase create validation 

function goal_base_create() {
    var mesg = "You must enter either pan number or aadhar number";
    $('#goal_base_create_id').formValidation({
        framework: 'bootstrap',

        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            goal_name: {
                validators: {
                    notEmpty: {
                        message: goalbasecreatenameempty
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: goalbasecreatenameinvalid
                                };
                            }
                        }
                    }
                }
            },
            goal_description: {
                validators: {
                    notEmpty: {
                        message: goalbasecreatedescempty
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: goalbasecreatedescinvalid
                                };
                            }
                        }
                    },
                }
            },

            //            due_year: {
            //                validators: {
            //                    notEmpty: {
            //                        message: goalbaseyearempty
            //                    },
            //                }
            //            },

            current_date_amount: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "") {
                                return {
                                    valid: false,
                                    message: goalbasecreatetargetamountempty
                                };
                            } else if (amountvalidation(value) == "notvalid") {
                                return {
                                    valid: false,
                                    message: goalbaseamountnotvalid
                                };
                            } else if (amountvalidation(value) == "invalidamount") {
                                return {
                                    valid: false,
                                    message: goalbaseinvalideamount
                                };
                            } else if (amountvalidation(value) == "decimalamount") {
                                return {
                                    valid: false,
                                    message: goalbasedecimalallowed
                                };
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },

            /*value_amount_tagetdate: {
             validators: {
             notEmpty: {
             message: goalbasevaluetargetdateempty
             },
             }
             },*/

            value_amount_tagetdate: {
                validators: {
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value == "") {
                                return {
                                    valid: false,
                                    message: goalbasevaluetargetdateempty
                                };
                            } else if (amountvalidation(value) == "notvalid") {
                                return {
                                    valid: false,
                                    message: goalbaseamountnotvalid
                                };
                            } else if (amountvalidation(value) == "invalidamount") {
                                return {
                                    valid: false,
                                    message: goalbaseinvalideamount
                                };
                            } else if (amountvalidation(value) == "decimalamount") {
                                return {
                                    valid: false,
                                    message: goalbasedecimalallowed
                                };
                            } else {
                                return true;
                            }
                        }
                    }
                }
            },

            person_name: {
                validators: {
                    notEmpty: {
                        message: goalbasepersonnameempty
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value != "") {
                                return {
                                    valid: chkSpecChars(value),
                                    message: goalbasepersonnameinvalid
                                };
                            }
                        }
                    },
                }
            },

            identity_proof: {
                validators: {
                    notEmpty: {
                        message: goalbaseimageempty
                    },
                }
            },
            /*goal_amount: {
             validators: {
             callback: {
             callback: function (value, validator, $field) {
             if (value == ""){
             return {
             valid: false,
             message: goalbaseamountempty
             };
             }
             else if (amountvalidation(value) == "notvalid"){
             return {
             valid: false,
             message: goalbaseamountnotvalid
             };
             }
             else if (amountvalidation(value) == "invalidamount"){
             return {
             valid: false,
             message: goalbaseinvalideamount
             };
             }
             else if (amountvalidation(value) == "decimalamount"){
             return {
             valid: false,
             message: goalbasedecimalallowed
             };
             }else{
             return true;
             }
             }
             }
             }
             },*/
        }
    })

}

//end here goal base create vali

function joint_address() {
    $('#add-form-addresss-joint').formValidation({
        framework: 'bootstrap',
        //        icon: {
        //            valid: 'glyphicon glyphicon-ok',
        //            invalid: 'glyphicon glyphicon-remove',
        //            validating: 'glyphicon glyphicon-refresh'
        //        },
        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            p_residence_address: {
                validators: {
                    notEmpty: {
                        message: 'Address is required'
                    },
                    stringLength: {
                        message: 'Address must be less than 30 characters',
                        max: function (value, validator, $field) {
                            return 200 - (value.match(/\r/g) || []).length;
                        }
                    }
                }
            },
            p_country: {
                validators: {
                    notEmpty: {
                        message: 'Country name is required'
                    },
                }
            },
            p_residence_state: {
                validators: {
                    notEmpty: {
                        message: 'State name is required'
                    },
                }
            },

            p_city: {
                validators: {
                    notEmpty: {
                        message: 'City name is required!'
                    },
                    regexp: {
                        regexp: '^[a-zA-Z ]*$',
                        message: 'Only alphabates are allowed'
                    },
                }
            },
            p_pincode_hidden: {
                validators: {
                    notEmpty: {
                        message: 'Pin code is required!'
                    },
                    stringLength: {
                        message: 'Pin code must be of 10 characters',
                        max: function (value, validator, $field) {
                            return 10 - (value.match(/\r/g) || []).length;
                        }
                    },
                    callback: {
                        callback: function (value, validator, $field) {

                            if (value != "") {
                                return {
                                    valid: chkalphaNumeric(value),
                                    message: 'Pin code should be alphanumeric ',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }

                        }
                    },
                }
            },
            p_mobile_no: {
                validators: {
                    regexp: {
                        regexp: '^[0-9]{10}$',
                        message: 'Please enter a valid mobile number'
                    },
                }
            },
            p_email_id: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
                        message: 'Please enter a valid email'
                    },
                }
            }/*,
             pri_permanent_address: {
             validators: {
             notEmpty: {
             message: 'Address is required'
             },
             stringLength: {
             message: 'Address must be less than 30 characters',
             max: function(value, validator, $field) {
             return 200 - (value.match(/\r/g) || []).length;
             }
             }
             }
             },
             pri_permanent_country: {
             validators: {
             notEmpty: {
             message: 'Country name is required'
             },
             }
             },
             pri_permanent_State: {
             validators: {
             notEmpty: {
             message: 'State name is required'
             },
             }
             },
             pri_permanent_State1: {
             validators: {
             notEmpty: {
             message: 'State name is required'
             },
             }
             },
             pri_city_id_permanent_hidden: {
             validators: {
             notEmpty: {
             message: 'City name is required!'
             },
             regexp: {
             regexp: '^[a-zA-Z ]*$',
             message: 'Only alphabates are allowed'
             },
             }
             },
             pri_pincode_permanent_hidden: {
             validators: {
             notEmpty: {
             message: 'Pin code is required!'
             },
             stringLength: {
             message: 'Pin code must be of 10 characters',
             max: function(value, validator, $field) {
             return 10 - (value.match(/\r/g) || []).length;
             }
             }
             
             }
             },
             pri_permanent_mobile_no: {
             validators: {
             regexp: {
             regexp: '^[0-9]{10}$',
             message: 'Please enter a valid mobile number'
             },
             }
             },
             pri_permanent_email: {
             validators: {
             regexp: {
             regexp: '^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$',
             message: 'Please enter a valid email'
             },
             }
             }*/


        }
    })

}



function joint_kyc() {
    var mesg = "You must enter either pan number or aadhar number";
    $('#samplesecondary-form-kyc').formValidation({
        framework: 'bootstrap',
        //        icon: {
        //            valid: 'glyphicon glyphicon-ok',
        //            invalid: 'glyphicon glyphicon-remove',
        //            validating: 'glyphicon glyphicon-refresh'
        //        },
        row: {
            selector: 'div',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            p_residential_status: {
                notEmpty: {
                    message: 'Resident status is required!!'
                },
            },
            s_residential_status: {
                notEmpty: {
                    message: 'Resident status is required!!'
                },
            },
            p_can_number: {
                validators: {
                    regexp: {
                        regexp: /^((?=(00))[0-1][1-6]|(?!(00))[0-1][0-6])([[01][0-9][0-9]|2[0-9][0-9]|3[0-6][0-7]|36[0-8]{3})([JCA]{3})([0-9][0-9])$/,
                        message: 'Not a vaild CAN number'
                    },
                }
            },
            s_can_number: {
                validators: {
                    regexp: {
                        regexp: /^((?=(00))[0-1][1-6]|(?!(00))[0-1][0-6])([[01][0-9][0-9]|2[0-9][0-9]|3[0-6][0-7]|36[0-8]{3})([JCA]{3})([0-9][0-9])$/,
                        message: 'Not a vaild CAN number'
                    },
                }
            },
            p_nationality: {
                validators: {
                    notEmpty: {
                        message: 'Mention nationality if other!'
                    },
                }
            },
            s_nationality: {
                validators: {
                    notEmpty: {
                        message: 'Mention nationality if other!'
                    },
                }
            },
            p_other_proof: {
                validators: {
                    notEmpty: {
                        message: 'Specify Other proof!!'
                    },
                }
            },
            s_other_proof: {
                validators: {
                    notEmpty: {
                        message: 'Specify Other proof!!'
                    },
                }
            },

            /*p_number: {
             // All the email address field have emailAddress class
             
             selector: '.numberkyc',
             validators: {
             callback: {
             message: mesg,
             callback: function(value, validator, $field) {
             var isPan = true;
             var isAadhar = true;
             var isEmpty = true,
             $fields = validator.getFieldElements('p_number');
             for (var i = 0; i < $fields.length; i++) {
             if ($fields.eq(i).val() !== '') {
             isEmpty = false;
             if ($($field).attr("name") == "p_pan_number") {
             if ($($field).val() == value) {
             isPan = chkPan($($field).val());
             }
             } else if ($($field).attr("name") == "p_aadhar_number") {
             if ($($field).val() == value) {
             isAadhar = chkaadhar($($field).val());
             }
             }
             break;
             }
             }
             if (!isEmpty && isPan && isAadhar) {
             // Update the status of callback validator for all fields
             validator.updateStatus('p_number', validator.STATUS_VALID, 'callback');
             return true;
             }
             if (!isPan) {
             return {
             valid: false,
             message: "Not a valid pan number"
             }
             } else if (!isAadhar) {
             return {
             valid: false,
             message: "Not a valid Aadhar number"
             }
             } else {
             mesg = "You must enter either pan number or aadhar number";
             }
             
             return false;
             }
             },
             //                    emailAddress: {
             //                        message: 'The value is not a valid email address'
             //                    }
             }
             },
             s_number: {
             // All the email address field have emailAddress class
             
             selector: '.numberkyc',
             validators: {
             callback: {
             message: mesg,
             callback: function(value, validator, $field) {
             var isPan = true;
             var isAadhar = true;
             var isEmpty = true,
             $fields = validator.getFieldElements('s_number');
             for (var i = 0; i < $fields.length; i++) {
             if ($fields.eq(i).val() !== '') {
             isEmpty = false;
             if ($($field).attr("name") == "s_pan_number") {
             if ($($field).val() == value) {
             isPan = chkPan($($field).val());
             }
             } else if ($($field).attr("name") == "s_aadhar_number") {
             if ($($field).val() == value) {
             isAadhar = chkaadhar($($field).val());
             }
             }
             break;
             }
             }
             if (!isEmpty && isPan && isAadhar) {
             // Update the status of callback validator for all fields
             validator.updateStatus('s_number', validator.STATUS_VALID, 'callback');
             return true;
             }
             if (!isPan) {
             return {
             valid: false,
             message: "Not a valid pan number"
             }
             } else if (!isAadhar) {
             return {
             valid: false,
             message: "Not a valid Aadhar number"
             }
             } else {
             mesg = "You must enter either pan number or aadhar number";
             }
             
             return false;
             }
             },
             //                    emailAddress: {
             //                        message: 'The value is not a valid email address'
             //                    }
             }
             }*/


        }
    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var userid = $('#userid').val();
        var pname = $('#p_name').val();
        var pnationlity = $('input[name="p_nationlity"]:checked').val();
        var presidential = $('#p_residential_status').val();
        var ppan = $('#p_pan_number').val();
        var paadhar = $('#p_aadhar_number').val();
        var pidentity = $('#p_identity_proof').val();
        var paddressproof = $('#p_address_proof').val();

        var ppoliticallytype = $('input[name="p_politically_exposed_type"]:checked').val();
        var sname = $('#s_name').val();
        var snationlity = $('input[name="s_nationlity"]:checked').val();
        var sresidential = $('#s_residential_status').val();
        var span = $('#s_pan_number').val();
        var saadhar = $('#s_aadhar_number').val();
        var sidentity = $('#s_identity_proof').val();
        var saddressproof = $('#s_address_proof').val();
        //var spoliticallytype = $('#s_politically_exposed_type').val();
        var spoliticallytype = $('input[name="s_politically_exposed_type"]:checked').val();


        var dataString = 'userid1=' + userid + '&pname1=' + pname + '&pnationlity1=' + pnationlity + '&presidential1=' + presidential
            + '&ppan1=' + ppan + '&paadhar1=' + paadhar + '&pidentity1=' + pidentity
            + '&paddressproof1=' + paddressproof + '&ppoliticallytype=' + ppoliticallytype
            + '&test1=' + sname + '&snationlity1=' + snationlity + '&sresidential1=' + sresidential
            + '&span1=' + span + '&saadhar1=' + saadhar + '&sidentity1=' + sidentity + '&saddressproof1=' + saddressproof + '&spoliticallytype1=' + spoliticallytype;


        $.ajax({
            type: "POST",
            url: JS_BASE_URL + "profile/jointaccountkyc",
            data: dataString,
            cache: false,
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (data) {
                //response = jQuery.parseJSON(data);
                $('.mainLoader').remove();
                $('body, html').animate({
                    scrollTop: 0
                }, '20000', 'swing');
                $('#form_submit_message').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-check green"></i> Data saved <strong class="green"> Successfully </strong>,');
                $('#profilepercentage').load(document.URL + ' #profilepercentage');
                $('.errorformSubmit').css("display", "block");
                if ($("#p_identity_proof").val() == "" && $("#s_identity_proof").val() == "") {
                    $("#kyctabj").find(".formcomplete").css("display", "none");
                } else {
                    $("#kyctabj").find(".formcomplete").css("display", "inline-block");
                }
                $('.tabbable').find('ul').find('li').removeClass('active');
                $('#incometabj').parent('li').addClass('active');
                $('#jointincome-details').addClass('active in');
                $('#jointKYC-details').removeClass('active in');


            }
        });
        return false;
    });

}

function joint_tax() {
    $('#profile-form-taxdetail-joint').formValidation({
        framework: 'bootstrap',
        //        icon: {
        //            valid: 'glyphicon glyphicon-ok',
        //            invalid: 'glyphicon glyphicon-remove',
        //            validating: 'glyphicon glyphicon-refresh'
        //        },
        row: {
            selector: 'label',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {
            p_city_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'City of Birth Is Required!'
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }

                }
            },
            s_city_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'City of Birth Is Required!'
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }

                }
            },
            p_country_of_birth: {
                validators: {
                    notEmpty: {
                        message: "Country of Birth Is Required!"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            s_country_of_birth: {
                validators: {
                    notEmpty: {
                        message: "Country of Birth Is Required!"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            p_country_of_citizenship: {
                validators: {
                    notEmpty: {
                        message: "Country of Citizenship Is Required!"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            s_country_of_citizenship: {
                validators: {
                    notEmpty: {
                        message: "Country of Citizenship Is Required!"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            p_country_of_nationality: {
                validators: {
                    notEmpty: {
                        message: 'Country of Nationality Is Required!'
                    },
                    callback: {
                        message: 'Country of Nationality Is Not valid!',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            s_country_of_nationality: {
                validators: {
                    notEmpty: {
                        message: 'Country of Nationality Is Required!'
                    },
                    callback: {
                        message: 'Country of Nationality Is Not valid!',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            p_radNation: {
                validators: {
                    notEmpty: {
                        message: "Please check to confirm !"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            s_radNation: {
                validators: {
                    notEmpty: {
                        message: "Please check to confirm !"
                    },
                    callback: {
                        message: 'Please enter a valid value',
                        callback: function (value) {
                            return {
                                valid: checkNameString(value)
                            };
                        }
                    }
                }
            },
            p_country_tax_residency_1: {
                validators: {
                    notEmpty: {
                        message: "Country of Tax Residency (1) Is Required!"
                    },
                }
            },
            s_country_tax_residency_1: {
                validators: {
                    notEmpty: {
                        message: "Country of Tax Residency (1) Is Required!"
                    },
                }
            },

            p_identification_type_1: {
                validators: {
                    notEmpty: {
                        message: 'Tax Identification Number (1) Is Required!'
                    },

                }
            },

            s_identification_type_1: {
                validators: {
                    notEmpty: {
                        message: 'Tax Identification Number (1) Is Required!'
                    },

                }
            },

            p_tin_1: {
                validators: {
                    notEmpty: {
                        message: "Identification Type (TIN or other, please specify) (1) Is Required!"
                    }
                }
            },
            s_tin_1: {
                validators: {
                    notEmpty: {
                        message: "Identification Type (TIN or other, please specify) (1) Is Required!"
                    }
                }
            }
        }
    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var dataString = $("#profile-form-taxdetail-joint").serialize();
        $.ajax({
            type: "POST",
            url: JS_BASE_URL + "profile/jointaccounttax",
            data: dataString,
            cache: false,
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (data) {
                //response = jQuery.parseJSON(data);
                $('.mainLoader').remove();
                $('body, html').animate({
                    scrollTop: 0
                }, '20000', 'swing');
                $('#form_submit_message').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-check green"></i> Data saved <strong class="green"> Successfully </strong>,');
                $('#profilepercentage').load(document.URL + ' #profilepercentage');
                $('.errorformSubmit').css("display", "block");
                if ($("#p_city_of_birth").val() == "" && $("#s_city_of_birth").val() == "") {
                    $("#taxtabj").find(".formcomplete").css("display", "none");
                } else {
                    $("#taxtabj").find(".formcomplete").css("display", "inline-block");
                }
                $('.tabbable').find('ul').find('li').removeClass('active');
                $('#nomineetab').parent('li').addClass('active');
                $('#nominee-details').addClass('active in');
                $('#jointtax-details').removeClass('active in');


            }
        });

        return false;
    });
}

function joint_bank() {
    $('#sample-form-bankdetail-joint').formValidation({
        framework: 'bootstrap',
        row: {
            selector: 'span',
            valid: 'has-success',
            invalid: 'has-error'
        },
        fields: {

            s_primary_ac_number: {
                validators: {
                    notEmpty: {
                        message: 'Account number is required!'
                    },
                    stringLength: {
                        message: 'Account number should not be greater than 30 characters',
                        max: function (value, validator, $field) {
                            return 30 - (value.match(/\r/g) || []).length;
                        }
                    },
                    digits: true
                }
            },
            s_primary_ac_ifsc: {
                validators: {
                    notEmpty: {
                        message: 'Ifsc code is required',
                    },
                    callback: {
                        callback: function (value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            if ($('#ifscid_1').val() == '') {
                                return {
                                    valid: false, // or false
                                    message: 'IFSC code not vaild'
                                }
                            }
                            return true;
                        }
                    },
                },
            },
            s_proof_of_account1: {
                validators: {
                    notEmpty: {
                        message: 'Proof of Account is required',
                    },
                }
            },
            primary_ac_joint_ac_holder: {
                validators: {
                    regexp: {
                        regexp: '^[a-zA-Z ]*$',
                        message: 'Only alphabates are allowed'
                    },
                    callback: {
                        callback: function (value, validator, $field) {

                            if (!$field.is('[readonly]')) {

                                return {
                                    valid: checkIfnull(value),
                                    message: 'Account holder name Is required!',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            } else {
                                return {
                                    message: '',
                                    //type: $field.intlTelInput('getNumberType')
                                };
                            }
                        }
                    },
                }

            }

        }

    }).on('success.form.fv', function (e) {
        // Prevent form submission
        e.preventDefault();
        var userid = $('#user_id').val();
        var sprimaryactype = $('#s_primary_ac_type').val();

        var version = $('#versionjoint').val();

        var accountnum = $('#accountnum').val();
        var sprimaryacnumber = $('#s_primary_ac_number').val();
        var sprimaryacifsc = $('#s_primary_ac_ifsc').val();
        var sprimaryacifscid = $('#s_primary_ac_ifscid').val();

        var sprimaryacmodeoperation = $('#s_primary_ac_mode_operation').val();
        var sprimaryacjointacholder = $('#s_primary_ac_joint_ac_holder').val();

        var sproofofaccount1 = $('#s_proof_of_account1').val();

        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'userid1=' + userid + '&accountnum1=' + accountnum + '&version1=' + version + '&sprimaryactype1=' + sprimaryactype + '&sprimaryacnumber1=' + sprimaryacnumber +
            '&sprimaryacifsc1=' + sprimaryacifsc + '&sprimaryacifscid1=' + sprimaryacifscid + '&sprimaryacmodeoperation1=' + sprimaryacmodeoperation +
            '&sprimaryacjointacholder1=' + sprimaryacjointacholder + '&sproofofaccount1=' + sproofofaccount1;
        //alert(userid);
        //console.log(dataString); return false;
        //alert(dataString); return false;
        //return false;
        // AJAX code to submit form.
        $.ajax({
            type: "POST",
            url: JS_BASE_URL + "profile/jointbank",
            data: dataString,
            cache: false,
            beforeSend: function () {
                $('body').prepend("<div class='mainLoader'><div class='loader2'></div></div>");
            },
            success: function (data) {
                //console.log(data);return false;
                //response = jQuery.parseJSON(data);
                $('.mainLoader').remove();
                $('body, html').animate({
                    scrollTop: 0
                }, '20000', 'swing');
                $('#form_submit_message').html('<button type="button" class="close" data-dismiss="alert"> <i class="ace-icon fa fa-times"></i> </button><i class="ace-icon fa fa-check green"></i> Data saved <strong class="green"> Successfully </strong>,');
                $('.errorformSubmit').css("display", "block");
                $('#profilepercentage').load(document.URL + ' #profilepercentage');
                if ($("#s_primary_ac_ifsc").val() == "") {
                    $("#banktabj").find(".formcomplete").css("display", "none");
                } else {
                    $("#banktabj").find(".formcomplete").css("display", "inline-block");
                }
                $('.tabbable').find('ul').find('li').removeClass('active');
                $('#kyctabj').parent('li').addClass('active');
                $('#jointKYC-details').addClass('active in');
                $('#jointbank-details').removeClass('active in');
                $("html, body").animate({ scrollTop: 0 }, "slow");

            }
        });
        return false;
    });

}








