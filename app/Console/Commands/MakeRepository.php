<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Exception\NamespaceNotFoundException;

class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository Class File';

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/Repository.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    /**
     * @param string $stub
     * @param string $name
     * @return $this|MakeRepository
     */
    protected function replaceNamespace(&$stub, $name)
    {
        parent::replaceNamespace($stub, $name);

        $searches = [
            'ModelNamespace',
            'ModelClass'
        ];
        $model = $this->option('model');
        $stub = str_replace($searches, $this->getModelClass($model), $stub);

        return $this;
    }

    /**
     * @param string|null $model
     * @return array|string[]
     */
    private function getModelClass(?string $model='') :array
    {
        // namespace
        $modelNamespace = 'App\Models\\' . $model;
        if(!class_exists($modelNamespace)){
            throw new NamespaceNotFoundException('Model Namespace Not Found : ' . $modelNamespace);
            //return ['', ''];
        }
        $modelNamespace = str_replace('/', '\\', $modelNamespace);
        $modelNamespace = str_replace('\\\\', '\\', $modelNamespace);

        // class name
        $namespaces = explode('\\', $modelNamespace);
        $namespaceLen = count($namespaces);
        $modelClass = $namespaces[$namespaceLen - 1];

        return [
            'use ' . $modelNamespace,
            $modelClass . '::class'
        ];
    }

}
