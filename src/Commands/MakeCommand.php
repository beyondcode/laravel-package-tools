<?php

namespace Beyondcode\LaravelPackageTools\Commands;

class MakeCommand extends GeneratorCommand
{
    protected $type = 'Command';

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('dummy:command', $this->option('command', 'command:name'), $stub);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/console.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Console\Commands';
    }
}