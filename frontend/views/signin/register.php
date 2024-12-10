<?php include(dirname(__FILE__) . "/header.php"); ?>

<div class="loginColumns animated fadeInDown white-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="apic">
                    <div class="col-sm-12 " style="margin-top: 13%; margin-left: -5%;">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="ibox-content" >
                                <div class="col-xs-12 am-login-col" style="margin-top: 3%; margin-bottom: 10%;">
                                    <div class="row">
                                        <div class="col-sm-6 am-login-col">
                                            <a class="btn btn-primarynew1 btn-block" href="<?= BASE_URL ?>loging">LOGIN</a>
                                        </div>
                                        <div class="col-sm-6 am-login-col">
                                            <a class="btn btn-primarynew btn-block" href="<?= BASE_URL ?>register">REGISTER</a>
                                        </div>
                                    </div>
                                </div>
                                <form id="form-signup" action="" role="form" >
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input type="text" class="input-group form-control textboxZ" placeholder="NAME" name="name" id="txtName" data-fv-field="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input type="text" class="form-control textboxZ" placeholder="EMAIL" name="user_signup_emails" id="user_signup_email" data-fv-field="user_signup_emails">          
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input type="number" class="form-control textboxZ" min='0' oninput="maxLengthCheck(this)" maxlength="10" placeholder="MOBILE NO." name="user_signup_mobile" id="user_signup_mobile" data-fv-field="user_signup_mobile">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dobcheckid" id="dobcheckid" value="">
                                    <div class="row" id="dobhide" style="display: none;">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input type="text" onchange="revalidation('form-signup-new', 'user_signup_dob')" id="user_signup_dob" class="form-control input-mask-datelogin" name="user_signup_dob" data-format="DD-MM-YYYY" data-template="DD-MM-YYYY"/>
                                                <div class="errorMessage" id="errorMessage" style="display:none;"></div></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input  name="user_signup_password" type="password" class="form-control textboxZ" placeholder="PASSWORD" id="user_signup_password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <input type="password" class="form-control textboxZ" name="user_signup_cpassword" placeholder="RE-ENTER PASSWORD" id="user_signup_cpassword" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="  form-group"> 
                                                <select id = "accounttyId" class="form-control" name="accountty">
                                                    <option>Investor</option>
                                                    <option>Advisor</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox i-checks" style="color:#fff;"> By registering you agree to the <a href="https://www.pmsaifworld.com/terms-and-conditions/" target="_blank" style="text-decoration: underline;color:#ffffff;">Terms and Conditions</a>. <label> <input id="agree" checked="checked" hidden="hidden" required="required" type="checkbox"><i></i></label></div>
                                    </div>
                                    <button type="submit" id="sign_up_button" class=" btn btn-primarynew block full-width m-b">Register</button>
                                    <a href="<?= BASE_URL ?>forgotpassword" class="am-forgot-password-mob" style="color:#fff;"> FORGOT PASSWORD</a>
                                </form>
                                <form id="otpsendprimarypopup" style="display:none">
                                    <div class="verifyPopup" style="height:20%; overflow-y:hidden;">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="  form-group"> 
                                                        <input autofocus type="number" autocomplete="on" class="input-group form-control textboxZ" name="otp" min='0' oninput="maxLengthCheck(this)" maxlength="4" placeholder="ENTER OTP" onkeyup="hideRemovedMessage();" value="" id="primaryotp" />
                                                        <div id="otpSuccessprimary1" style="display:none"></div>
                                                        <div id="otpreturnValue1" style="display:none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="hideMsgTimerResnd " class="form-group">
                                                <span class="js-resend-otp font-size-12 disabledAnchor" id="disabledAnchorTag"><span class="label label-danger spanResendOTP" id="ResendOTPDisabledButton" onclick="return sendRegisterOtp('user_signup_mobile');">Resend OTP</span>
                                                    <span id="hideMsgTimer" style="display:none">
                                                        <?php
                                                        /*$messageOtp = $GLOBALS['messages']['userRegistration']['timerOutOTPMessage'];
                                                        if (!empty($messageOtp)) {
                                                            echo $messageOtp;
                                                        }*/
                                                        ?>
                                                    </span>
                                                </span>

                                            </div>

                                            <div class="row form-group" align="center" id="otpindian">
                                                <a class="btn btn-primarynew block full-width m-b" onclick="return verifyOtpRegister('primaryotp');">Verify Mobile</a>
                                            </div>
                                        </div>

                                    </div><!-- /.modal-content -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col-sm-7 am-desktop-col-text" id="#faltu">
                <h2 class="font-bold piss-login-head">Login to the World of TopClass Investment Opportunities !</h2>
                <p style="font-size: 14px;text-align: justify;">
                    <br>
                    PMS AIF World is the Industry's First platform of this kind. 
                    <br><br>
                    Login to Learn - Compare - Select from the universe of professionally managed focussed investment portfolios.
                    <br><br>
                    It presents updated information on Product - Performance - Portfolios attributes for one to make a well informed decision. 
                    <br><br>
                    <strong>"Successful investing is about owning businesses and reaping the huge rewards provided by the dividends and earnings growth"</strong> - John Bogle 
                </p>
            </div>
        </div>
    </div>
</div>
<?php include(dirname(__FILE__) . "/footer.php"); ?>

<style>
    .logo-name1 {
        color: #163850;
        font-size: 68px;
        font-weight: 800;
        letter-spacing: -5px;
        margin-bottom: 10%;
        margin-top: 35%;

    }
    .loginColumns {
        padding: 50px 20px 100px 20px;
    }
    .btn-primarynew {
        background-color: #916416;
        border-color: #916416;
        color: #FFFFFF;
    }
    .btn-primarynew1 {
        background-color: #fff;
        border-color: #fff;
        color: #000;
    }
    .ibox-content {
        background-color: #183f70;
        color: inherit;
        padding: 15px 20px 20px 20px;
        border-color: #183f70;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }
    .form-control, .single-line {
        background-color: #194071;
        background-image: none;
        border: 1px solid #fff;
        border-radius: 1px;
        color: #fff;
        display: block;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
    }
    .fv-form-bootstrap .help-block {
        margin-bottom: 8px;
        color: rgb(255, 255, 255);
        font-size: 15px;
        margin-top: -3px;
        float: left;
    }
    .fv-form-bootstrap .fv-icon-no-label {
        top: 0px;
        right: 9px;
        color: #916914;
    }
    .btn {
        border-radius: 0px;
    }
    .apic{
        border: 0px solid black;
        min-height: 390px;
        background: url(static/img/logo-n-min.png);
        background-repeat: no-repeat;
        background-size: 400px;
    }
    .col-sm-10 {
        width: auto;
    }
    h2 {
        font-size: 28px;
    }

    .forgot-piss {margin-left: 45%;}
    .piss {width: 130% !important}
    .am-forgot-password-mob {display: block; text-align: right;}
    .am-desktop-col-text {width:58.33%;}

    @media only screen and (max-width: 768px) { .piss {width: 100% !important}
                                                .forgot-piss {margin-left: auto !important;}
                                                .piss-login-head {font-size: 19px !important}
                                                .am-forgot-password-mob {margin-left: 0%;}
                                                .am-desktop-login {display: none;}
                                                .am-desktop-col-text {width:100%;}
                                                .am-form-top-pad {margin-top: 10vh;}
                                                .am-login-col {
                                                    padding-left: 0px;
                                                    padding-right: 0px;
                                                }
                                                .btn-primarynew,
                                                .btn-primarynew1 {
                                                    width: 90%;
                                                    margin: 0 auto;
                                                }
                                                .apic {
                                                    background-size: 100%; 
                                                }
                                                .loginColumns {
                                                    padding-bottom: 50px;
                                                }
    }
    @media only screen and (min-width: 769px) { 
        .am-mob-login {display: none;}
    }
    .form-control, .single-line {
        background-color: #194071;
        background-image: none;
        border: 1px solid #fff;
        border-radius: 1px;
        color: #fff;
        display: block;
        padding: 0px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
    }
    select {
        height: 33px !important;
        color: #fff;
    }
</style>

