<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @noinspection PhpUnusedPrivateMethodInspection
     *
     * @return list<string> An array of allowed values for APP_ENV
     *
     * @phpstan-ignore method.unused (called by Symfony's imported KernelTrait)
     */
    private function getAllowedEnvs(): array
    {
        return ['prod', 'dev', 'test'];
    }
}
