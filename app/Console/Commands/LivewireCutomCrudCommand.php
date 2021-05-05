<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class LivewireCutomCrudCommand extends Command
{
    protected $signature = 'make:rust-cms {nameOfTheClass? : Name of the class} {nameOfTheModelClass? : Name of the model class}';
    protected $description = 'Run this command and we will create a livewire crud components for you';

    protected $nameOfTheClass;
    protected $nameOfTheModelClass;
    protected $file;

    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    public function handle()
    {
        //EN-618-FN
        $this->gatherParameters();                  // Gather all parameters
        $this->generateLivewireCrudClassfile();     // Create Class files
        $this->generateLivewireCrudViewFile();      // Create View files
    }

    protected function gatherParameters()
    {
        $this->nameOfTheClass = $this->argument('nameOfTheClass');
        $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');

        // If you didn't input the name of the class
        if (!$this->nameOfTheClass) {
            $this->nameOfTheClass = $this->ask('Enter Class Name');
        }

        // If you didn't input the name of the class
        if (!$this->nameOfTheModelClass) {
            $this->nameOfTheModelClass = $this->ask('Enter Model Name');
        }

        // Convert to studly case
        $this->nameOfTheClass = Str::studly($this->nameOfTheClass);
        $this->nameOfTheModelClass = Str::studly($this->nameOfTheModelClass);
    }

    /**
     * Generate the CRUD Class file(s) => app/Http/Livewire
     * @return void
     */
    protected function generateLivewireCrudClassfile()
    {
        // Set the origin and destination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/Livewire/' . $this->nameOfTheClass . '.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This class file already exists: ' . $this->nameOfTheClass . '.php');
            $this->info('Aborting class file creation.');
            return false;
        }

        // Get the original string content of the file
        $fileOriginalString = $this->file->get($fileOrigin);

        // Replace the strings specified in the array sequentially
        $replaceFileOriginalString = Str::replaceArray('{{}}',
            [
                $this->nameOfTheModelClass, // Name of the model class
                $this->nameOfTheClass,      // Name of the class
                $this->nameOfTheModelClass, // Name of the model class
                $this->nameOfTheModelClass, // Name of the model class
                $this->nameOfTheModelClass, // Name of the model class
                $this->nameOfTheModelClass, // Name of the model class
                $this->nameOfTheModelClass, // Name of the model class
                Str::kebab($this->nameOfTheClass), // From "FuckYou" to "fuck-you"
            ],
            $fileOriginalString
        );

        // Put the content into the destination directory
        $this->file->put($fileDestination, $replaceFileOriginalString);
        $this->info('Livewire class file created: ' . $fileDestination);
    }

    /**
     * generateLivewireCrudViewFile
     * @return void
     */
    protected function generateLivewireCrudViewFile()
    {
        // Set the origin and destination for the livewire class file
        $fileOrigin = base_path('/stubs/custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOfTheClass) . '.blade.php');

        if ($this->file->exists($fileDestination)) {
            $this->info('This view file already exists: ' . Str::kebab($this->nameOfTheClass) . '.php');
            $this->info('Aborting view file creation.');
            return false;
        }

        // Copy file to destination
        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('Livewire view file created: ' . $fileDestination);
    }
}