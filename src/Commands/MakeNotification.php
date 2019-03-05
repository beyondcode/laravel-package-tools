<?php

namespace Beyondcode\LaravelPackageTools\Commands;

class MakeNotification extends GeneratorCommand
{
    protected $type = 'Notification';

    protected function getStub()
    {
        return __DIR__.'/stubs/notification.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Notifications';
    }
}