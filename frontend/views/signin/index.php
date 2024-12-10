<?php
      $model = new \common\models\User();
     $rows = $model->Logingpage($_POST['user_login_email']);
     $getValCount = count($rows);
     $getVal ='';
     $inactiveCount=0;
    $message = '';
    $isError=false;
            
    foreach($rows as $key => $val){
         if($val['is_acitve']==0 && $val['parent_id'] !=''){
             $inactiveCount = $inactiveCount+1;            
         }         
     }
     if($getValCount==0){
         $message= $GLOBALS['messages']['userActiveInactive']['invalidUser'];
         $isError=true;
    // }
     }else if($getValCount==$inactiveCount){
         $message= $GLOBALS['messages']['userActiveInactive']['acountDisaled'];
         $isError=true;
     }
            
     
     
if(count($rows)==1 && $isError==false){
    ?>
    <div class="page-wrap login">

        <?php include(dirname(__FILE__) . "/header.php"); ?>
        	
        <div class="mainwrapper loginheight">
            <div class="formpanelmiddle">
                <div class="forminner">
                    <ul class="formnavigation">
                        <?php if(!empty(userregistrationonoff) && strtolower(userregistrationonoff)!="off") { ?>
                            <li class="register"><a href="<?= BASE_URL ?>signin/register">Register</a></li>
                        <?php }else{ ?>
                            <li class="register"><a href="<?= BASE_URL ?>signin/contactus">Register</a></li>
                        <?php } ?>
                        <li class="login active"><a href="<?= BASE_URL ?>signin/loging">Login</a></li>
                    </ul>
                    <div class="formArea">
                        <div class="show-login-error">

                        </div>
                        <form id="login_form1" method="POST">
                            <div class="row paddingbottom">
                                <div class="col-xs-12">
                                    <div class="input-group custominput"> <span class="formicon"> <img src="<?= STATIC_URL ?>images/usericon/usericon.png" alt=""  width="20"> </span>
                                        <input type="text" autocomplete="off" class="form-control textboxZ" name="user_login_email" id="user_login_email"       value="<?php echo $_POST['user_login_email']; ?>" placeholder="EMAIL / MOBILE NO." required="required" readonly />
                                        <!--<input type="text" class="form-control " placeholder="EMAIL / MOBILE NO.">-->
                                    </div>
                                </div>
                            </div>



                            <div class="row paddingbottom">
                                <div class="col-xs-12">
                                    <div class="input-group custominput"> <span class="formiconpwd"> <img src="<?= STATIC_URL ?>images/usericon/passwordicon.png" alt=""  width="20"> </span>
                                        <!--<input type="text" class="form-control textboxZ" placeholder="PASSWORD">-->
                                        <input autofocus type="password" autocomplete="off" id="user_login_password" minlength="6" name="user_login_password" class="form-control textboxZ"  placeholder="PASSWORD"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" align="">
                                <div class="col-md-8 remberme">
                                </div>
                                <div class="col-md-4 forgotpwd"><a href="<?= BASE_URL ?>forgotpassword">forgot password</a></div>
                            </div>

                            <div class="row" align="center">
                                <button type="submit" id="sign_in_button" class="buttonX">
                                    sign in
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>



    <?php include(dirname(__FILE__) . "/footer.php"); ?>
    <?php
}else if(count($rows)>1  && $isError==false){
    ?>
    <div class="page-wrap login">

        <?php include(dirname(__FILE__) . "/header.php"); ?>
         <div class="mainwrapper loginheight">
            <div class="formpanelmiddle">
                <div class="forminner">
                    <ul class="formnavigation">
                        <?php if(!empty(userregistrationonoff) && strtolower(userregistrationonoff)!="off") { ?>
                        <li class="register"><a href="<?= BASE_URL ?>signin/register">Register</a></li>
                        <?php }else{ ?>
                            <li class="register"><a href="<?= BASE_URL ?>signin/contactus">Register</a></li>
                        <?php } ?>
                        <li class="login active"><a href="<?= BASE_URL ?>signin/loging">Login</a></li>
                    </ul>
                    <div class="formArea">
                        <div class="show-login-error">

                        </div>
                        <form id="login_form" method="POST">
                            <div class="row paddingbottom">
                                <div class="col-xs-12">
                                    <div class="input-group custominput"> <span class="formicon"> <img src="<?= STATIC_URL ?>images/usericon/usericon.png" alt=""  width="20"> </span>
                                        <input type="text" autocomplete="off" class="form-control textboxZ" name="user_login_email" id="user_login_email" value="<?php echo $_POST['user_login_email']; ?>"  placeholder="EMAIL / MOBILE NO." required="required" readonly/>
                                        <!--<input type="text" class="form-control " placeholder="EMAIL / MOBILE NO.">-->
                                    </div>
                                </div>
                            </div>
                            <div class="row paddingbottom">
                                <div class="col-xs-12">
                                    <span class="dob">Date Of Birth</span>
                                    <input onchange="revalidation('login_form', 'user_login_dob')" type="text" autocomplete="off" id="user_login_dob"  name="user_login_dob" data-format="DD-MM-YYYY" data-template="DD-MM-YYYY" class="form-control textboxZ"  required="required"/>
                                </div>
                            </div>

                            <div class="row paddingbottom">
                                <div class="col-xs-12">
                                    <div class="input-group custominput"> <span class="formiconpwd"> <img src="<?= STATIC_URL ?>images/usericon/passwordicon.png" alt=""  width="20"> </span>
                                        <!--<input type="text" class="form-control textboxZ" placeholder="PASSWORD">-->
                                        <input autofocus type="password" autocomplete="off" id="user_login_password" minlength="6" name="user_login_password" class="form-control textboxZ"  placeholder="PASSWORD"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row" align="">
                                <div class="col-md-8 remberme">

                                </div>
                                <div class="col-md-4 forgotpwd"><a href="<?= BASE_URL ?>forgotpassword">forgot password</a></div>
                            </div>

                            <div class="row" align="center">
                                <button type="submit" id="sign_in_button" class="buttonX">
                                    sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 
    </div>


    <?php include(dirname(__FILE__) . "/footer.php"); ?>
    <?php
}
else{
        $session = Yii::$app->session;
               \Yii::$app->session['errormessage'] = [
                   'error' => $message,
               ];
      return Yii::$app->getResponse()->redirect('loging');

}

?>



<style>
    .combodate select.year {
    width: 34%!important;
}
    </style>
    