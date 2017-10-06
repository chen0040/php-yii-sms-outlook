<?php
$jqmUrl=Yii::app()->baseUrl.'/jqm';
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
<link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl.'/img'; ?>/favicon.ico" type="image/x-icon" />	
<link rel="stylesheet"  href="<?php echo $jqmUrl; ?>/css/themes/default/jquery.mobile.css" />
<link rel="stylesheet" href="<?php echo $jqmUrl; ?>/docs/_assets/css/jqm-docs.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.mobile.css" />

<script src="<?php echo $jqmUrl; ?>/js/jquery.tag.inserter.js"></script>
<script src="<?php echo $jqmUrl; ?>/js/jquery.js"></script>
<script src="<?php echo $jqmUrl; ?>/docs/_assets/js/jqm-docs.js"></script>
<script src="<?php echo $jqmUrl; ?>/js/"></script>

<style type="text/css">
.ui-page .ui-content .ui-btn.cancel-btn .ui-btn-inner {
    color      : white;
    background : red;
};
</style>

<?php Yii::app()->accountMgr->applyLanguage(); ?>
<title><?php echo Yii::t('translation', Yii::app()->name); ?></title>
</head>

<body>


<?php echo $content; ?>



</body>
</html>