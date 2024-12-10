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
                                            <a class="btn btn-primarynew btn-block" href="<?= BASE_URL ?>loging">LOGIN</a>
                                        </div>
                                        <div class="col-sm-6 am-login-col">
                                            <a class="btn btn-primarynew1 btn-block" href="<?= BASE_URL ?>register">REGISTER</a>
                                        </div> 
                                    </div>
                                </div>
                                <form id="forgotpassword" method="POST" action="<?= BASE_URL ?>forgotpassword">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group"> 
                                                <strong style="color: #fff;">FORGOT PASSWORD?</strong>
                                                <p class="am-forgot-pass-p" style="color: #fff;font-size: 14px; margin-top: 2%;">Simply provide the following  <br> details and we will send across <br> instructions to login</p>
                                            
                                                <input type="text" autocomplete="off" class="input-group custominput form-control textboxZ" name="user_login_email" id="user_login_email" value="" placeholder="EMAIL" required="required" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12" id="errorId">
                                        </div>
                                    </div>
                                    <button type="submit" id="sign_in_button" class="btn btn-primarynew block full-width m-b buttonX">SUBMIT</button>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 am-desktop-col-text" >
                <h2 class="font-bold piss-login-head">Login to the World of TopClass Investment Opportunities !</h2>
                <p style="font-size: 14px;text-align: justify;">
                    <br>
                    PMS AIF World is the Industry's First platform of this kind. 
                    <br><br>
                    Login to Lear - Compare - Select from the universe of professionally managed focussed investment portfolios.
                    <br><br>
                    It presents updated information on Product - Performance - Portfolios attributes for one to make a well informed decision. 
                    <br><br>
                    <strong>"Successful investing is about owning businesses and reaping the huge rewards provided by the dividends 
                        and earnings growth"</strong> - John Bogle 
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
        /* width: 100%; */
    }
    .fv-form-bootstrap .fv-icon-no-label {
        top: 0px;
        right: 9px;
        color: #fff;
    }
    .btn {
        border-radius: 0px;
    }
    .apic{
        border: 0px solid black;
        height: 390px;

        background:url(static/img/logo-n-min.png);
        background-repeat: no-repeat;
        background-size: contain;

    }
    .col-sm-10 {
        width: auto;
    }
    h2 {
        font-size: 28px;
    }

    
.forgot-piss {margin-left: 45%;}
.piss {width: 130% !important}
.am-desktop-col-text {width:58.33%;}

@media only screen and (max-width: 768px) { .piss {width: 100% !important}
.forgot-piss {margin-left: auto !important;}
.piss-login-head {font-size: 19px !important}
.am-desktop-login {display: none;}
.am-login-col {padding-left: 0px; padding-right: 0px;}
.apic {height: 345px;}
.am-forgot-pass-p {font-size: 9px;}
.am-desktop-col-text {width:100%;}
.btn-primarynew,
.btn-primarynew1 {
    width: 90%;
    margin: 0 auto;
}
.loginColumns {
    padding-bottom: 50px;
}
}
@media only screen and (min-width: 769px) { 
.am-mob-login {display: none;}}

</style>
