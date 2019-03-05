<?php

namespace BeyondCode\LaravelPackageTools\Commands;

use Illuminate\Support\Arr;

class Composer
{
    public function get(string $key, $default = null)
    {
        return Arr::get($this->parse(), $key, $default);
    }

    protected function parse(): array
    {
        return json_decode($this->getComposerJson(), true);
    }

    protected function getComposerJson(): string
    {
        $composerJson = getcwd().'/composer.json';

        if (! file_exists($composerJson)) {
        }

        return file_get_contents($composerJson);
    }
}
