<?php
include($_SERVER['DOCUMENT_ROOT'].'/app/example/config.php');
?>

<html>
<head>
<title><?=$this->e($title)?> | <?=$this->e($company)?></title>
<?php $template->bootstrap(); ?>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
<div class="container-fluid">
<?php $template->menu(); ?>
</div>
</nav>

<div class="container">

<?=$this->section('content')?>

</div>

</body>

<?php $template->bootstrap_footer(); ?>

<?=$this->section('scripts')?>

</html>
