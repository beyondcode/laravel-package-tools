<?php

namespace Beyondcode\LaravelPackageTools\Commands;

class MakeRequest extends GeneratorCommand
{
    protected $type = 'Request';

    protected function getStub()
    {
        return __DIR__.'/stubs/request.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Requests';
    }
}