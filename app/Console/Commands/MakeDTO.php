<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDTO extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create DTO Class File';

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/Dto.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\DTO';
    }
}
