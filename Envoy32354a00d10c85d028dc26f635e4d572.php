<?php $servers = isset($servers) ? $servers : null; ?>
 <?php require_once('vendor/autoload.php'); ?>
<?php

use App\Server;
$servers = Server::all();

?>

<?php $__container->servers(['deployable' => ['user@192.168.1.1'], 'localhost' => ['127.0.0.1']]); ?>

<?php $__container->startTask('deploy', ['on' => 'localhost']); ?>
    ls -la
<?php $__container->endTask(); ?>