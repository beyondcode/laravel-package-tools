<?php

namespace BeyondCode\LaravelPackageTools\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /** @var OutputInterface */
    protected $output;

    /** @var InputInterface */
    protected $input;

    /** @var Composer */
    protected $composer;

    public function __construct()
    {
        $this->composer = new Composer();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    abstract protected function getStub();

    /**
     * Execute the console command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool|null
     */
    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if (! $this->input->getOption('force') && $this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory(Str::before($path, basename($path)));

        file_put_contents($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }
    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return file_exists($this->getPath($this->qualifyClass($rawName)));
    }

    public function info($text)
    {
        $this->output->write('<info>'.$text.'</info>');
    }

    public function error($text)
    {
        $this->output->write('<error>'.$text.'</error>');
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return getcwd().'/src/'.str_replace('\\', '/', $name).'.php';
    }

    protected function getNameInput(): string
    {
        return trim($this->input->getArgument('name'));
    }

    protected function rootNamespace()
    {
        $autoload = $this->composer->get('autoload.psr-4');

        return array_keys($autoload)[0];
    }


    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace'],
            [$this->getNamespace($name), $this->rootNamespace()],
            $stub
        );

        return $this;
    }

    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyClass', $class, $stub);
    }

    protected function getDefaultNamespace(string $rootNamespace)
    {
        return $rootNamespace;
    }

    protected function makeDirectory(string $path)
    {
        @mkdir($path, 0777, true);
    }

    public function option($name, $default = null)
    {
        if ($this->input->hasOption($name)) {
            return $this->input->getOption($name) ?? $default;
        }

        return $default;
    }

}