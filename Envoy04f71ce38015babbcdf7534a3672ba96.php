<?php $servers = isset($servers) ? $servers : null; ?>

<?php

use App\Server;
$servers = Server::get();

?>

<?php $__container->servers(['deployable' => ['user@192.168.1.1'], 'localhost' => ['127.0.0.1']]); ?>

<?php $__container->startTask('deploy', ['on' => 'localhost']); ?>
    ls -la
<?php $__container->endTask(); ?>