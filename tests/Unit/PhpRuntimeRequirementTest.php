<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class PhpRuntimeRequirementTest extends TestCase
{
    #[DataProvider('versions')]
    public function test_only_supported_patched_runtimes_are_accepted(string $version, bool $accepted): void
    {
        $process = new Process([PHP_BINARY, __DIR__.'/../../scripts/check-php-version.php', $version]);
        $process->run();

        $this->assertSame($accepted ? 0 : 1, $process->getExitCode(), $process->getOutput().$process->getErrorOutput());
    }

    public static function versions(): array
    {
        return [
            'obsolete PHP 7' => ['7.4.33', false],
            'unsupported PHP 8.2' => ['8.2.35', false],
            'unsupported PHP 8.3' => ['8.3.36', false],
            'vulnerable PHP 8.4' => ['8.4.26', false],
            'patched PHP 8.4' => ['8.4.27', true],
            'later PHP 8.4 patch' => ['8.4.28', true],
            'vulnerable PHP 8.5' => ['8.5.11', false],
            'patched PHP 8.5' => ['8.5.12', true],
            'later PHP 8.5 patch' => ['8.5.13', true],
            'prerelease' => ['8.5.12RC1', false],
            'untested branch' => ['8.6.0', false],
            'missing FPM version' => ['', false],
            'malformed FPM version' => ['PHP 8.5.12', false],
        ];
    }
}
