<?php include(dirname(__FILE__) . "/header.php"); ?>
<div class="section-authentication-cover">
    <div class="">
        <div class="row g-0">
            <div
                class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                    <div class="card-body">
                        <img src="<?= STATIC_URL ?>assets/images/login-images/login-cover.svg"
                            class="img-fluid auth-img-cover-login" width="650" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                    <div class="card-body p-sm-5">
                        <div class="">
                            <div class="mb-3 text-center">
                                <img src="<?= STATIC_URL ?>assets/images/logo-icon.png" width="60" alt="">
                            </div>
                            <div class="text-center mb-4">
                                <h5 class="">Hello Admin</h5>
                                <p class="mb-0">Please log in to your account</p>
                            </div>
                            <div class="form-body">
                                <form id="login_form" method="POST" class="row g-3">
                                    <div class="col-12">
                                        <div class="col-xs-12">
                                            <div class="  form-group">
                                                <label for="inputEmailAddress" class="form-label">Email/Mobile</label>
                                                <input type="text" autocomplete="off"
                                                    class="input-group custominput form-control textboxZ"
                                                    name="user_login_email" id="user_login_email" value=""
                                                    placeholder="EMAIL / MOBILE NO." required="required" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="inputEmailAddress" class="form-label">Password</label>
                                                <input autofocus type="password" autocomplete="off"
                                                    id="user_login_password" minlength="6" name="user_login_password"
                                                    class="input-group custominput form-control textboxZ"
                                                    placeholder="PASSWORD" />
                                            </div>
                                        </div>
                                        <p style="color:red;" id="errormsgId" style="display:none;"> </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end"> <a href="<?= BASE_URL ?>forgot-password">Forgot
                                            Password ?</a>
                                    </div>
                                    <button type="submit" id="sign_in_button"
                                        class="btn btn-primarynew block full-width m-b buttonX btn btn-primary">SUBMIT</button>

                                </form>



                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->
    </div>
</div>




<?php include(dirname(__FILE__) . "/footer.php"); ?>