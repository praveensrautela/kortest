<?php
 use common\models\Utility;
$action="dashboard";
try{
if(!empty($this->params['page_header_info']['action'])){
		$action=$this->params['page_header_info']['action'];
}
if(!empty($this->params['user_info']['name'])){
		$name	=	$this->params['user_info']['name'];
}else if(!empty($this->params['user_info']['primary_email'])){
			$name	=	$this->params['user_info']['primary_email'];
}else if(!empty($this->params['user_info']['primary_mobile_number'])){
			$name	=	$this->params['user_info']['primary_mobile_number'];
}
		\Yii::$app->language = 	!empty($_COOKIE["language"])	?	$_COOKIE["language"]	:	'en';
} catch (ErrorException $e) {
                $utility = new Utility();
                 $getuserid = !empty($_COOKIE["uid"]) ? $_COOKIE["uid"] : 0;
                 $userAccess = !empty($_COOKIE["user_access"]) ? $_COOKIE["user_access"] : '';
                 if(!empty($getuserid) || empty($userAccess) || !empty($userAccess)){
                             $utility->exceptionErrorCookiesBeforeAction($e);
                 }
              //dashboarderrorlog
           //  return BASE_URL . 'signin/loging';
                 $utility = new Utility();
                 $utility->Sessionexipary();

            }
?>
	
<div class="page-header">
		
		<?php   if($action=='timeline')	{
				?>
			<h1>
						<?= \Yii::t('invest_quick', 'Profile Builder'); ?>
						<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								<?=	\Yii::t('invest_quick',	'Timeline');	?>

						</small>
				</h1>
    
		<?php }else if	(!empty($this->params['page_header_info']))	{
				?>
				<h1>
					<?php	echo  \Yii::t('invest_quick',$this->params['page_header_info']['name']) ?>
						<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								<?php	echo    \Yii::t('invest_quick',$this->params['page_header_info']['sub_name']) ?>
						</small>
				</h1>
                 <div class="widget-toolbar no-border" style="margin-top: -36px;">
                     <ul class="nav nav-tabs" id="recent-tab">
                        <li style="background-color:#d54c7e!important; border: 2px solid; border-color: #fff;">
                            <a style="color: #fff;" href="<?= BASE_URL ?>upload-statement-pdf"><?= \Yii::t('invest_quick', 'Upload your CAMS Statement'); ?>
                           <i class="ace-icon fa fa-share bigger-135"></i> 
                            </a>
                        </li>

                    </ul>
                </div>
    
				<?php
		}	else{
				?>
    
			<h1>
						<?= \Yii::t('invest_quick', 'Error Page'); ?>
						<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								<?=	\Yii::t('invest_quick',	'Something Went Wrong');	?>

						</small>
				</h1>
		<?php } ?>
</div>