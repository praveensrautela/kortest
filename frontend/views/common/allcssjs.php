<?php //

use common\models\Utility;

$utility = new Utility();
$con = Yii::$app->controller->id;
$con = Yii::$app->controller->id;

?>
<script>
    var JS_BASE_URL = '<?= BASE_URL ?>';
</script>

<!-- for login page   -->
<script src="<?= STATIC_URL; ?>js/jQuery-1.11.2.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/bootstrap.min.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/bootstrap-select.min.js"></script>
<script defer="defer" src="<?= STATIC_URL; ?>js/combodate.js"></script>
<script src='<?= STATIC_URL; ?>js/design.js?v=<?= STATIC_SITE_CONTENT_VERSION; ?>'></script>
<script defer="defer" src="<?= STATIC_URL; ?>js/validator.js?v=<?php echo STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script defer="defer"
    src="<?= STATIC_URL; ?>js/framework/bootstrap.min.js?v=<?php echo STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script src="<?= STATIC_URL; ?>js/valdate-form.js?v=<?php echo STATIC_SITE_CONTENT_VERSION; ?>"></script>
<script defer="defer" src="<?= STATIC_URL; ?>js/jquery.form.js?v=<?php echo STATIC_SITE_CONTENT_VERSION; ?>"></script>
<!-- for login page   -->

<!-- new theme assets start -->

<!--plugins-->
<link href="<?= STATIC_URL ?>assets/plugins/simplebar/css/simplebar.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet" />
<link href="<?= STATIC_URL ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet" />
<link href="<?= STATIC_URL ?>assets/plugins/metismenu/css/metisMenu.min.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet" />
<!-- loader-->
<link href="<?= STATIC_URL ?>assets/css/pace.min.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet" />
<script src="<?= STATIC_URL ?>assets/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link href="<?= STATIC_URL ?>assets/css/bootstrap.min.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet">
<link href="<?= STATIC_URL ?>assets/css/bootstrap-extended.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
<link href="<?= STATIC_URL ?>assets/css/app.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet">
<link href="<?= STATIC_URL ?>assets/css/icons.css?v=<?= STATIC_SITE_CONTENT_VERSION ?>" rel="stylesheet">

<!-- ////////////////////////////////////////////////////////////////////// -->

<!-- Bootstrap JS -->
<script src="<?= STATIC_URL ?>assets/js/bootstrap.bundle.min.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script>
	<!--plugins-->
	<!-- <script src="<?= STATIC_URL ?>assets/js/jquery.min.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script> -->
	<script src="<?= STATIC_URL ?>assets/plugins/simplebar/js/simplebar.min.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script>
	<script src="<?= STATIC_URL ?>assets/plugins/metismenu/js/metisMenu.min.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script>
	<script src="<?= STATIC_URL ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="<?= STATIC_URL ?>assets/js/app.js?v=<?= STATIC_SITE_CONTENT_VERSION ?>"></script>

<!-- new theme assets end -->


