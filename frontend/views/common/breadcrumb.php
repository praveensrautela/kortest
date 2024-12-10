<?php
use common\models\User;
use common\models\Utility;
$user = new User();
$utility = new Utility();
try {
            $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
        } catch (ErrorException $e) {
            $utility = new Utility();
            $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
            $this->redirect(BASE_URL . 'loging');
        }
        if (!empty($getuserid)) {
           // $user_id = $utility->descriptionFormatforcookie($getuserid);
            $user_id = $getuserid;
        }else{
        $user_id = Yii::$app->user->identity->id;
            
        }

$checkadminflag = $user->Checkadmin($user_id);?>

<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary1 " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
        <li >
            <a style="float:none" href="https://www.pmsaifworld.com/terms-and-conditions/" target="_blank"><i class="fa fa-info-circle fa-6"></i> <span class="nav-label">Copyright</span></a>
        </li>
        <?php if(!empty($checkadminflag)) { ?>
           <li >
            <a  style="float:none" href="<?= BASE_URL ?>users"><i class="fa fa-user-circle fa-6"></i> <span class="nav-label">Admin User</span></a>
            </li>
        <?php } ?>
        <li >
            <a id="Setmore_button_iframe" style="float:none" href="https://my.setmore.com/bookingpage/fcde52df-18f2-4186-9aa8-aa92d01778da"><i class="fa fa-phone fa-6"></i> <span class="nav-label">Book a Call</span></a>
        </li>
        <li >
                <a class="right-sidebar-toggle">
                    <i class="fa fa-tasks"></i>
                </a>
            </li>



        </ul>


    </nav>
    <div id="right-sidebar" class="animated">
        <div class="sidebar-container">

            <!--                            <ul class="nav nav-tabs navs-3">
                        
                                            <li class="active"><a data-toggle="tab" href="#tab-1">
                                                Notes
                                            </a></li>
                                            <li><a data-toggle="tab" href="#tab-2">
                                                Projects
                                            </a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-3">
                                                <i class="fa fa-gear"></i>
                                            </a></li>
                                        </ul>-->

            <div class="tab-content">
                <div id="tab-2" class="tab-pane active">

                    <ul class="sidebar-list">
                        <li>
                            <a href="<?= BASE_URL ?>setting">
                                <i class="fa fa-gear"></i> <strong>&nbsp; Setting</strong>
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>logout">
                                <i class="fa fa-power-off"></i><strong>&nbsp; Log out</strong>
                            </a>
                        </li>
                    </ul>

                </div>


            </div>

        </div>



    </div>
</div>
<div class="row " >
    <div style="padding: 5px 5px 5px 5px; background-color: #916914;"><a href="https://www.pmsaifworld.com/terms-and-conditions/" target="_blank"><span class="nav-label" style="font-size: 11px;text-align: justify;color:#ffffff;">
             Unless otherwise indicated, the site and the content is PMS AIF World’s  (“us”) proprietary and all source code, databases, functionality, software, website design, videos, text, charts, graphics on the site (collectively, the “Content”) and the trademarks and logos contained therein (the “Marks”) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various intellectual property laws of India.
          </span></a></div>
</div>
                            

