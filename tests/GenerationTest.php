<?php

namespace BeyondCode\LaravelPackageTools\Commands\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use BeyondCode\LaravelPackageTools\Commands\MakeJob;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\BufferedOutput;
use BeyondCode\LaravelPackageTools\Commands\MakeRule;
use BeyondCode\LaravelPackageTools\Commands\MakeEvent;
use BeyondCode\LaravelPackageTools\Commands\MakeCommand;
use BeyondCode\LaravelPackageTools\Commands\MakeRequest;
use BeyondCode\LaravelPackageTools\Commands\MakeFactory;
use BeyondCode\LaravelPackageTools\Commands\MakeMigration;
use BeyondCode\LaravelPackageTools\Commands\MakeNotification;

class GenerationTest extends TestCase
{
    use MatchesSnapshots;

    protected $outputPath;

    function setUp(): void
    {
        parent::setUp();
        $this->outputPath = __DIR__.'/output/src/';
    }

    /** @test */
    public function it_can_make_rule_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleRule',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeRule;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Rules/ExampleRule.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Rules/ExampleRule.php');
    }

    /** @test */
    public function it_can_make_command_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleCommand',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeCommand;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Console/Commands/ExampleCommand.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Console/Commands/ExampleCommand.php');
    }

    /** @test */
    public function it_can_make_request_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleRequest',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeRequest;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Http/Requests/ExampleRequest.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Http/Requests/ExampleRequest.php');
    }

    /** @test */
    public function it_can_make_job_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleJob',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeJob;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Jobs/ExampleJob.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Jobs/ExampleJob.php');
    }

    /** @test */
    public function it_can_make_event_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleEvent',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeEvent;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Events/ExampleEvent.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Events/ExampleEvent.php');
    }

    /** @test */
    public function it_can_make_notification_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleNotification',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeNotification;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'/Notifications/ExampleNotification.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'/Notifications/ExampleNotification.php');
    }

    /** @test */
    public function it_can_make_migration_classes()
    {
        $input = new ArrayInput([
            'name' => 'create_example_migrations_table',
            '--create' => 'example_migrations',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
            new InputOption('create'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeMigration;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'../database/migrations/create_example_migrations_table.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'../database/migrations/create_example_migrations_table.php');
    }

    /** @test */
    function it_can_make_model_factory_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleFactory',
            '--model' => 'ExampleFactoryModel',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force'),
            new InputOption('model'),
        ]));

        $output = new BufferedOutput();

        $command = new MakeFactory;
        $command->outputPath = $this->outputPath;
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath.'../database/factories/ExampleFactory.php'));
        $this->assertMatchesFileSnapshot($command->outputPath.'../database/factories/ExampleFactory.php');
    }
}
