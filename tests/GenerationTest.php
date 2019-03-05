<?php

namespace BeyondCode\LaravelPackageTools\Commands\Tests;

use BeyondCode\LaravelPackageTools\Commands\MakeCommand;
use BeyondCode\LaravelPackageTools\Commands\MakeEvent;
use BeyondCode\LaravelPackageTools\Commands\MakeJob;
use BeyondCode\LaravelPackageTools\Commands\MakeNotification;
use BeyondCode\LaravelPackageTools\Commands\MakeRequest;
use BeyondCode\LaravelPackageTools\Commands\MakeRule;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;

class GenerationTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_can_make_rule_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleRule',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeRule;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Rules/ExampleRule.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Rules/ExampleRule.php');
    }

    /** @test */
    public function it_can_make_command_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleCommand',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeCommand;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Console/Commands/ExampleCommand.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Console/Commands/ExampleCommand.php');
    }

    /** @test */
    public function it_can_make_request_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleRequest',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeRequest;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Http/Requests/ExampleRequest.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Http/Requests/ExampleRequest.php');
    }

    /** @test */
    public function it_can_make_job_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleJob',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeJob;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Jobs/ExampleJob.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Jobs/ExampleJob.php');
    }

    /** @test */
    public function it_can_make_event_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleEvent',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeEvent;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Events/ExampleEvent.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Events/ExampleEvent.php');
    }

    /** @test */
    public function it_can_make_notification_classes()
    {
        $input = new ArrayInput([
            'name' => 'ExampleNotification',
            '--force' => true,
        ], new InputDefinition([
            new InputArgument('name'),
            new InputOption('force')
        ]));

        $output = new BufferedOutput();

        $command = new MakeNotification;
        $command->outputPath = __DIR__ . '/output/';
        $command->__invoke($input, $output);

        $this->assertTrue(file_exists($command->outputPath . '/Notifications/ExampleNotification.php'));
        $this->assertMatchesFileSnapshot($command->outputPath . '/Notifications/ExampleNotification.php');
    }
}
