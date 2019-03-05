<?php

namespace BeyondCode\LaravelPackageTools\Commands;

class MakeJob extends GeneratorCommand
{
    protected $type = 'Job';

    protected function getStub()
    {
        return $this->option('sync')
            ? __DIR__.'/stubs/job.stub'
            : __DIR__.'/stubs/job-queued.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Jobs';
    }
}