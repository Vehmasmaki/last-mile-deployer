 <?php require_once('vendor/autoload.php'); ?>
<?php
use App/Servers;

?>

<?php $__container->servers(['deployable' => ['user@192.168.1.1'], 'localhost' => ['127.0.0.1']]); ?>

<?php $__container->startTask('deployment', ['on' => 'deployable']); ?>
    ls -la
<?php $__container->endTask(); ?>