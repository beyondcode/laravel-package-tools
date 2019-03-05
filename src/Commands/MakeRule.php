<?php

namespace BeyondCode\LaravelPackageTools\Commands;

class MakeRule extends GeneratorCommand
{
    protected $type = 'Rule';

    protected function getStub()
    {
        return __DIR__.'/stubs/rule.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Rules';
    }
}
