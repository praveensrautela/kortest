<?php

//print_r($message);
//if (!empty($_GET['emailverify'])) {
//    echo $_GET['emailverify'];
//}

    use yii\helpers\Html;

//$this->title = $name;
    $utility = new common\models\Utility;
?>
<body  class="home page page-id-5 page-template-default  jt_main_content have_rev_slider is_front_page wpb-js-composer js-comp-ver-4.8.1 vc_responsive jt-sticky-enabled login-layout light-login" >
    <div class="loaderr">
        <img src="<?= STATIC_URL; ?>images/loader.gif" alt="loader">
    </div>
    <?php
        if (Yii::$app->session->hasFlash('verify')) {
            echo Yii::$app->session->getFlash('verify');
            Yii::$app->session->removeFlash('verify');
        }
    ?>
    <div class="wrapper" >
        <div class="container-fluid padding-zero jt-main-banner-holder">
            <div id="jt-first-section" class="jt-page-header  jt-blog-page" >
                <div class="displayunder991 table">
                    <div class="table-cell left">
                        <img src="<?= STATIC_URL; ?>images/banner_991.png" alt="bannerLogo">
                    </div>
                    <div class="table-cell right">
                        <h3 class="heading-slide fs_obj fs_obj_active">Honest and Simple financial products that change lives</h3>

                        <a class="button-slide" data-backdrop="static" data-toggle="modal" data-target="#myModal">Become a Member &amp; Stay Updated</a>
                    </div>
                </div>
                <div class="jt-banner-overlay wGr">
                    <div class="slider-wrapper">
                        <div class="responisve-container">
                            <div class="slider">
                                <div class="fs_loader"></div>
                                <div class="slide" data-in="slideLeft">

                                    <img src="<?= STATIC_URL; ?>images/slider-mark.png"  alt="slider-mark" data-position="215,450" data-in="fade" data-delay="500">

                                    <h3 class="heading-slide" data-position="321,1044" data-in="fade">Honest and Simple financial<br>products that change lives</h3>
                                    <p data-position="510,1044" data-in="fade"  data-delay="300"><a class="button-slide" href="<?= BASE_URL ?>signin/index">Become a Member & Stay Updated</a></p>
                                    <img src="<?= STATIC_URL; ?>images/slider-line1.png"  alt="slider-line1" data-position="265,525" data-in="top" data-delay="1000">
                                    <img src="<?= STATIC_URL; ?>images/slider-line2.png"  alt="slider-line2" data-position="442,451" data-in="left" data-delay="2000">
                                    <img src="<?= STATIC_URL; ?>images/slider-line3.png"  alt="slider-line3" data-position="538,515" data-in="bottomRight" data-delay="3000">
                                    <img src="<?= STATIC_URL; ?>images/slider-line4.png"  alt="slider-line4" data-position="604,645" data-in="bottom" data-delay="4000">

                                    <p class="teaser" data-position="240,390" data-in="bottom" data-delay="1500">Free <br>Membership</p>
                                    <p class="teaser" data-position="430,320" data-in="bottom" data-delay="2500">Commission <br>Free</p>
                                    <p class="teaser" data-position="620,410" data-in="bottom" data-delay="3500">Ease of <br>Use</p>
                                    <p class="teaser" data-position="708,520" data-in="bottom" data-delay="4500">Community <br>Centered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include(dirname(__FILE__) . "/../common/header.php"); ?>
            </div>
        </div>
        <div class="container-fluid padding-zero jt_content_holder">
            <div class="entry-content page-container content-ctrl"> <!-- Main Container -->
                <div class="container-fluid padding-zero"> <!-- Container -->
                    <div class="main-content col-lg-12 padding-zero">
                        <article id="post-5" class="post-5 page type-page status-publish hentry">
                            <div class="entry-content">
                                <div class="vc_row jt_row_class wpb_row vc_row-fluid whoWeAre column-have-space">
                                    <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation" >
                                        <div class="space-fix " style="">
                                            <div class="wpb_wrapper">
                                                <div class="jt-intro-wrapper jt-intro-wrapper-extrawidth ">
                                                    <!--																										<div class="getmessage">
                                                                        <ul class="listing"></ul>
                                                                        </div>-->
                                                    <!-- Intro Content -->
                                                    <div class="jt-intro-content sep-hover-control">
                                                        <div class="jt-intro-text">
                                                            Who are we
                                                            <div class="jt-sep-two"></div>
                                                        </div>
                                                        <h3>Bharosa Club is a community for those who desire to improve their financial well-being.</h3>
                                                        <div class="jt-intro-inner">
                                                            <p>Members are free to use the club the way they like – scout for information, get deals, seek advice or buy products & services which are in line with their individual goals and requirements.</p>
                                                            <a href="<?= BASE_URL; ?>about" class="jt-intro-learn-more right-animate-icon" style=""  target="_blank" > Learn more <img src="<?= STATIC_URL; ?>images/arrows/box-arrow-right.png" alt="Box Arrow Right"> </a> </div>
                                                    </div>
                                                    <!-- Intro Content -->
                                                </div>
                                                <!-- Intro Main Content -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row jt_row_class wpb_row vc_row-fluid column-have-space">
                                    <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation" >
                                        <div>
                                            <div class="space-fix " style="">
                                                <div class="wpb_wrapper ">
                                                    <div class="jt-heading ">
                                                        <p class="jt-slide-tit" style="">What we offer</p>
                                                        <h4 class="jt-main-head" style="font-size:22px;">Our Services</h4>
                                                        <div class="jt-sep"></div>
                                                        <h4 class="sub-heading" style="">We offer Honest and Simple financial products that change lives</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation" >
                                            <div>
                                                <div class="space-fix " style="">
                                                    <div class="wpb_wrapper scale70">
                                                        <div class="jt-process-wrapper  jt-process-extrawidth">
                                                            <ul class="jt-process-cnt">
                                                                <li>
                                                                    <div class="jt-process-content one"><a title=" " href="<?= BASE_URL; ?>individuals#funds">
                                                                            <div class="jt-cnt-icon"><i class=" pe-7s-cash" style=""></i></div>
                                                                            <div class="jt-cnt-heading" style="">Mutual Funds</div>
                                                                            <p>Did you miss the great wealth creation opportunity provided by Equity Mutual Funds?</p></a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="jt-process-content two"><a title=" " href="<?= BASE_URL; ?>individuals#insurance">
                                                                            <div class="jt-cnt-icon"><i class=" pe-7s-loop" style=""></i></div>
                                                                            <div class="jt-cnt-heading" style="">Insurance</div>
                                                                            <p>Chances are, you were sold a bad insurance policy by your broker!</p></a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="jt-process-content three"><a title=" " href="<?= BASE_URL; ?>individuals#loans">
                                                                            <div class="jt-cnt-icon"><i class=" pe-7s-calculator" style=""></i></div>
                                                                            <div class="tpl2">
                                                                                <div class="jt-cnt-heading">Loans</div>
                                                                                <p>The price of a loan should not get in the way of your dreams!</p></a>
                                                                    </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="jt-process-content four"><a title=" " href="<?= BASE_URL; ?>individuals#advisory">
                                                                            <div class="jt-cnt-icon"><i class="pe-7s-users" style=""></i></div>
                                                                            <div class="jt-cnt-heading tpt7">Advisory Services</div>
                                                                            <p>Not getting financial advice is bad. Getting bad financial advice is worse.</p></a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="jt-process-content five"><a title=" " href="<?= BASE_URL; ?>individuals#deals">
                                                                            <div class="jt-cnt-icon"><i class="pe-7s-like2" style=""></i></div>
                                                                            <div class="jt-cnt-heading" style="">Member Only Deals</div>
                                                                            <p style="">Wouldn’t it be nice to get discounts without having to negotiate?</p></a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="jt-process-round-wrapper">
                                                                <div class="jt-process-round"></div>
                                                                <img src="<?= STATIC_URL; ?>images/logo-symbol.png" alt="logo-symbol">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row jt_row_class wpb_row vc_row-fluid vc_custom_1442231869501 column-zero-space">
                                    <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation" >
                                        <div>
                                            <div class="space-fix " style="">
                                                <div class="wpb_wrapper">
                                                    <div class="jt-heading ">
                                                        <p class="jt-slide-tit" style="">Why us</p>
                                                        <h4 class="jt-main-head" style="font-size:22px;">What allows us to offer you <br>cheaper products</h4>
                                                        <div class="jt-sep"></div>
                                                        <h4 class="sub-heading repHover" style="">Why do loans, insurance and mutual funds cost you so much today?</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-why clearfix">
                                        <div class="vc_col-sm-4 wpb_column vc_column_container  has_animation" >
                                            <div>
                                                <div class="space-fix " style="">
                                                    <div class="wpb_wrapper">
                                                        <div class="services-style-three sep-hover-control services-style-three-extrawidth ">
                                                            <div class="jt-ser-three-overlay"></div>
                                                            <div class="services-icon" style=""><i class="pe-7s-scissors"></i></div>
                                                            <div class="services-content nohover">
                                                                <h3 style="">High Commission Cost</h3>
                                                                <div class="jt-sep-two"></div>
                                                                <p>Businesses pay commissions to agents and brokers for getting them customers. These commissions are built into the price of products you buy.</p>
                                                            </div>

                                                            <div class="services-content hover">
                                                                <h3 style="">No Commission Fee</h3>
                                                                <div class="jt-sep-two"></div>
                                                                <p>We only sell commission free products. Naturally these products are cheaper.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_col-sm-4 wpb_column vc_column_container  has_animation" >
                                            <div class="space-fix " style="">
                                                <div class="wpb_wrapper">
                                                    <div class="services-style-three sep-hover-control services-style-three-extrawidth ">
                                                        <div class="jt-ser-three-overlay"></div>
                                                        <div class="services-icon" style=""><i class="pe-7s-arc" style=""></i></div>
                                                        <div class="services-content nohover">
                                                            <h3 style="">High Acquisition Cost</h3>
                                                            <div class="jt-sep-two"></div>
                                                            <p>Every company individually spends money to acquire and service customers. This cost also gets factored in their price.</p>
                                                        </div>
                                                        <div class="services-content hover">
                                                            <h3 style="">Low Acquisition Cost</h3>
                                                            <div class="jt-sep-two"></div>
                                                            <p>Our platform reduces the cost of doing business for companies due to economies of scale. This saving gets passed on to you in the form of cheaper products.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_col-sm-4 wpb_column vc_column_container  has_animation" >
                                            <div class="space-fix " style="">
                                                <div class="wpb_wrapper">
                                                    <div class="services-style-three sep-hover-control services-style-three-extrawidth ">
                                                        <div class="jt-ser-three-overlay"></div>
                                                        <div class="services-icon" style=""><i class="pe-7s-mouse" style=""></i></div>
                                                        <div class="services-content nohover">
                                                            <h3 style="">No Economies of Scale</h3>
                                                            <div class="jt-sep-two"></div>
                                                            <p>When you take a loan or buy insurance or even a smart phone, you are just one customer. Your ability to negotiate the best deal is difficult.</p>
                                                        </div>
                                                        <div class="services-content hover">
                                                            <h3 style="">Economies of Scale</h3>
                                                            <div class="jt-sep-two"></div>
                                                            <p>With a large member base, our ability to negotiate better rates across products & services increases.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row jt_row_class wpb_row vc_row-fluid vc_custom_1441793507596 column-have-space">
                                    <div class="container">
                                        <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation">
                                            <div>
                                                <div class="space-fix  text-center" style="">
                                                    <div class="jt-heading jt-testi-head">
                                                        <p class="jt-slide-tit" style="">What we promise</p>
                                                        <h2 style="">What you can be assured of</h2>
                                                        <div class="jt-sep"></div>
                                                        <h4 class="sub-heading" style="">"Bharosa Club" is founded on the principle of “Bharosa” or trust of people united by a common interest or goal.</h4>
                                                    </div>
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <div class="col-sm-4 ">
                                                                    <div class="cs-services-heading">
                                                                        <div class="cs-services-icon">
                                                                            <i class="pe-7s-medal" style=""></i>
                                                                        </div>
                                                                        <h5 style="">Honesty</h5>
                                                                        <p>We are a commission free platform, so you’ll always find unbiased  products which have passed the friends & family test</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 ">
                                                                    <div class="cs-services-heading">
                                                                        <div class="cs-services-icon">
                                                                            <i class="pe-7s-lock" style=""></i>
                                                                        </div>
                                                                        <h5 style="">Security & Privacy</h5>
                                                                        <p>World class Security which prevents unauthorized use and protects your personal information</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 ">
                                                                    <div class="cs-services-heading">
                                                                        <div class="cs-services-icon">
                                                                            <i class="pe-7s-users" style=""></i>
                                                                        </div>
                                                                        <h5 style="">Assistance</h5>
                                                                        <p>We will have a large team of on-ground associates and a customer support team to handle any questions or concerns you may have</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row jt_row_class wpb_row vc_row-fluid vc_custom_1445086125894 column-have-space">
                                    <div class="container">
                                        <div class="vc_col-sm-12 wpb_column vc_column_container  has_animation" >
                                            <div>
                                                <div class="space-fix " style="">
                                                    <div class="wpb_wrapper">
                                                        <div class="flnce-abt-slide flnce-abt-slide-extrawidth ">
                                                            <div class="container">
                                                                <div class="jt-heading jt-testi-head">
                                                                    <p class="jt-slide-tit" style="">Media mentions</p>
                                                                    <h2 style="">What they say about us</h2>
                                                                    <div class="jt-sep"></div>
                                                                </div>
                                                                <div id="jt-testimonial-slide" class="jt-testimonials-style-three have-number-nav">
                                                                    <div class="flnce-slide-cont sep-hover-control">
                                                                        <div class="testi-name"><img src="<?= STATIC_URL; ?>images/logo-toi.png" alt="Times of India"></div>
                                                                        <a href="<?= BASE_URL; ?>media-1">
                                                                            <h4 class="testihead">Ex-PayPal exec builds low-cost MF platform</h4>
                                                                            <p class="slide-cont">Sanjay Bhargava, the man credited by PayPal co-founder Elon Musk as being the brains behind the payment company's low-cost account authentication strategy, is setting up a digital 'utility company' to enable micro investments in mutual funds with minimal cost.</p></a>
                                                                    </div>
                                                                    <div class="flnce-slide-cont sep-hover-control">
                                                                        <div class="testi-name"><img src="<?= STATIC_URL; ?>images/logo-inc42.png" alt="INC 42 Magazine"></div>
                                                                        <a href="<?= BASE_URL; ?>media-2">
                                                                            <h4 class="testihead">Empowering Households Financially, Bharosa Club Wants To Make Billions By Serving Millions</h4>
                                                                            <p class="slide-cont">Imagine buying a financial product becoming as simple as buying a sachet of shampoo. Sounds too simple when you think of the current complexities involved in understanding and buying a financial instrument?</p></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- end main-content -->

                </div>
                <!-- End Container -->
            </div>
        </div>
        <!-- End Main Container -->
        <?php include(dirname(__FILE__) . "/../common/footer.php"); ?>
    </div>
    <?php if (!empty($message)) { ?>
            <script>
                $(document).ready(function () {
                    $('#confirm').modal();
                });
                function getLogin() {
                    $('#confirm').modal('hide');
                    $('#myModal').modal();
                }
            </script>
            <div class="modal fade" id="confirm" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Email Verification</h4>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $message; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onClick="getLogin('confirm');">Login</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <?php } ?>
</body>