<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespace = 'App\Repository';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $argument = $this->input->getArgument('name');
        $repositoryName = trim($argument);
        
        $fileName = $this->modelName($repositoryName) . 'Repository.php';

        if($this->files->exists( app_path('Repository/' . $fileName)))
        {
            $this->error('Repository sudah ada.');
            return false;
        }

        $paths = explode('/', $repositoryName);
        $directory = app_path('Repository');
        
        if(count($paths) > 1) {
            $content = array_slice($paths, 0, -1);
            $this->namespace = implode('\\', $content);
            $this->namespace = "App\Repository\\" . $this->namespace;
            
            $directory .= "/";
            $directory .= implode("/", $content);

            $repositoryName = last($paths);
        }

        $stub = $this->files->get( storage_path('app/stubs/repository.stub'));
        
        $stub = str_replace('MyRepositoryNamespace', $this->modelName($this->namespace), $stub);
        $stub = str_replace('MyRepository', $this->modelName($repositoryName) . 'Repository', $stub);

        if (!is_dir($directory))
            $this->files->makeDirectory($directory, 0755, true);
        
        $this->files->put( app_path('Repository/' . $fileName), $stub);
        
        $this->info('Berhasil membuat repository');
    }

    /**
     * Make first word is uppercase.
     *
     * @param string $name
     * @return string
     */
    private function modelName(string $name)
    {
        return ucfirst($name);
    }
}
