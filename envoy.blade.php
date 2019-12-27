@include('public/index.php')
@php

use App\Server;
$servers = Server::get();

dd($servers);

@endphp

@servers(['deployable' => ['user@192.168.1.1'], 'localhost' => ['127.0.0.1']])

@task('deploy', ['on' => 'localhost'])
    ls -la
@endtask