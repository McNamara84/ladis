<?php

// Check the real runtime before Composer's platform override is applied.
// An explicit version lets deployment validate the PHP-FPM binary as well.
$version = $argv[1] ?? PHP_VERSION;
$manifest = json_decode(file_get_contents(__DIR__.'/../composer.json'), true, flags: JSON_THROW_ON_ERROR);
$requirements = explode(' || ', $manifest['require']['php']);

foreach ($requirements as $requirement) {
    if (! preg_match('/^~(\d+\.\d+)\.(\d+)$/D', $requirement, $matches)) {
        fwrite(STDERR, "Unsupported PHP requirement format: {$requirement}\n");
        exit(1);
    }

    if (preg_match('/^'.preg_quote($matches[1], '/').'\.\d+$/D', $version)
        && version_compare($version, substr($requirement, 1), '>=')) {
        echo "PHP {$version} satisfies the security baseline.\n";
        exit(0);
    }
}

fwrite(STDERR, "PHP {$version} is unsupported or missing security fixes. Required: {$manifest['require']['php']}.\n");
exit(1);
