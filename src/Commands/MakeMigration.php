<?php

namespace BeyondCode\LaravelPackageTools\Commands;

use Illuminate\Support\Str;

class MakeMigration extends GeneratorCommand
{
    protected $type = 'Migration';

    protected function getStub()
    {
        return __DIR__.'/stubs/migration.stub';
    }

    protected function qualifyClass($name)
    {
        return $this->rootNamespace() . '\\..\\database\\migrations\\' . $name;
    }

    protected function replaceClass($stub, $name)
    {
        $stub = str_replace('CreateDummiesTable', $this->getClassName($stub, $name), $stub);

        return str_replace('dummies', $this->option('create', 'table_name'), $stub);
    }

    protected function getClassName($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        return ucfirst(Str::camel($class));
    }
}
