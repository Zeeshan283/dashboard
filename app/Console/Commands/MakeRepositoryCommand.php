<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Check if the Repositories directory exists, if not, create it
        $repositoryDirectory = app_path('Repositories');
        if (!File::exists($repositoryDirectory)) {
            File::makeDirectory($repositoryDirectory);
        }

        // Generate the repository class file path
        $repositoryPath = $repositoryDirectory . DIRECTORY_SEPARATOR . $name . 'Repository.php';

        // Check if the repository file already exists
        if (File::exists($repositoryPath)) {
            $this->error('Repository already exists!');
            return;
        }

        // Read the stub file content
        $stub = file_get_contents(__DIR__ . '/stubs/repository.stub');

        // Replace placeholders in the stub file content
        $stub = str_replace('{{name}}', $name, $stub);

        // Create the repository file with the replaced content
        File::put($repositoryPath, $stub);

        $this->info('Repository created successfully.');
    }
}
