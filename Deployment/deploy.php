<?php

// All Deployer recipes are based on `recipe/common.php`.
require 'recipe/symfony3.php';

// Define a server for deployment.
// Let's name it "prod" and use port 22.
server('prod', 'coderdojo.nl', 22)
    ->user('seer')
    ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
    ->stage('production')
    ->env('deploy_path', '/site'); // Define the base path to deploy your project to.

task('set_cache_rights', function(){
    cd('/site/current');
    run('sudo chmod 777 -R var/cache');
});

before('deploy', 'set_cache_rights');
after('deploy', 'set_cache_rights');

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'git@github.com:CoderDojoNederland/website.git');
