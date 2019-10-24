<?php

namespace BeyondCode\LaravelPackageTools\Commands;

class MakeFactory extends GeneratorCommand
{
    protected $type = 'Factory';

    protected function getStub()
    {
        return __DIR__.'/stubs/factory.stub';
    }

    protected function qualifyClass($name)
    {
        return $this->rootNamespace().'\\..\\database\\factories\\'.$name;
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace\\'],
            ['Models\\'.$this->option('model', 'Factory'), $this->rootNamespace()],
            $stub
        );

        return $this;
    }

    protected function replaceClass($stub, $name)
    {
        return str_replace('Dummy::class', $this->option('model', 'Factory').'::class', $stub);
    }
}
