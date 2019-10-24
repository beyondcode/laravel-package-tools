<?php

namespace BeyondCode\LaravelPackageTools\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends GeneratorCommand
{
    protected $type = 'Model';

    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        parent::__invoke($input, $output);

        if ($this->input->getOption('migration')) {
            $this->createMigration();
        }

        if ($this->input->getOption('factory')) {
            $this->createFactory();
        }
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Models';
    }

    private function createMigration()
    {
        $table = Str::snake(Str::plural(class_basename($this->getNameInput())));

        $this->runCommand("create_{$table}_table", ['--create' => "{$table}"], new MakeMigration);

        $this->info(PHP_EOL."Created migration: create_{$table}_table");
    }

    protected function createFactory()
    {
        $model = $this->getNameInput();

        $this->runCommand("{$model}Factory", ['--model' => "{$model}"], new MakeFactory);

        $this->info(PHP_EOL.'Factory created successfully.');
    }

    protected function runCommand($name, $options, GeneratorCommand $command)
    {
        $input = new ArrayInput(
            array_merge([
            'name'  => $name,
            '--force' => false,
            ], $options),
            new InputDefinition([
                new InputArgument('name'),
                new InputOption('create'),
                new InputOption('model'),
                new InputOption('force'),
            ])
        );

        $output = new BufferedOutput();

        $command->outputPath = ($this->outputPath);

        $command->__invoke($input, $output);
    }
}
