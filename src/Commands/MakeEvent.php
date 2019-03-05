<?php

namespace BeyondCode\LaravelPackageTools\Commands;

class MakeEvent extends GeneratorCommand
{
    protected $type = 'Event';

    protected function getStub()
    {
        return __DIR__.'/stubs/event.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Events';
    }
}