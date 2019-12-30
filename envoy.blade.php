@include('public/index.php')
@setup
	use App\Server;
	use App\App_settings;
	$servers = Server::with('credentials')->get();

	// Array of deployable servers for tasks
	$deployable = [];

	foreach($servers as $server){

		$credentials = $server->credentials->first();

		// Check if the server is flagged for updates and it has credentials in the database
		if($server->perform_updates == 1 && $credentials){
			
			$deployable[] =  $credentials->username . "@" .$server->ipv4;
		}
	}

	// Gets repository from the database
	$settings = App_settings::all();
	$repository = $settings->where('option', 'repository')->pluck('value')->first();

	if($repository){
		print "repository not defined";
		die();
	}

	// These should be moved to the database in the extended releases
    $releases_dir = '/home/lmd/lmd-releases';
    $app_dir = '/home/lmd/lmd-prod';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup
@servers(['deployable' => $deployable, 'localhost' => ['127.0.0.1']])


@story('deploy_laravel')
    clone_repository
    update_symlinks
@endstory

{{-- Makes a shallow clone of the repository --}}
@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    {{-- git reset --hard {{ $commit }} --}}
@endtask

{{-- Add composer installations here and 'run_composer' to the deployment story --}}
@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask

{{-- Creates symlinks between production directory and the new release directory --}}
@task('update_symlinks')

	echo "Linking app directory"
    ln -nfs {{ $app_dir }}/app {{ $new_release_dir }}/app
    echo "Linking vendor directory"
    ln -nfs {{ $app_dir }}/vendor {{ $new_release_dir }}/vendor
    echo "Linking js directory"
    ln -nfs {{ $app_dir }}/public/js {{ $new_release_dir }}/public/js
    echo "Linking css directory"
    ln -nfs {{ $app_dir }}/public/css {{ $new_release_dir }}/public/css
    echo "Linking js vendor directory"
    ln -nfs {{ $app_dir }}/public/vendor {{ $new_release_dir }}/public/vendor
    echo "Linking resources directory"
    ln -nfs {{ $app_dir }}/resources {{ $new_release_dir }}/resources

@endtask


{{-- Clears caches --}}
@task("clear_caches")
 rm {{ $app_dir }}/storage/framework/views/*
@endtask