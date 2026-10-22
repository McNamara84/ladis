<?php

// Use the patched CI runtime instead of a third-party PHP 7.4 Docker image.
$report = $argv[1] ?? 'coverage.xml';
$destination = $argv[2] ?? 'output/coverage.svg';
$coverage = simplexml_load_file($report, options: LIBXML_NONET);
$metrics = $coverage === false ? null : $coverage->project->metrics;

if ($metrics === null || ! isset($metrics['statements'], $metrics['coveredstatements'])) {
    fwrite(STDERR, "Clover report is missing project coverage metrics.\n");
    exit(1);
}

$total = (int) $metrics['statements'];
$covered = (int) $metrics['coveredstatements'];
if ($total < 0 || $covered < 0 || $covered > $total) {
    fwrite(STDERR, "Clover report contains invalid coverage metrics.\n");
    exit(1);
}

$percentage = $total === 0 ? 0 : round(100 * $covered / $total, 1);
$color = $percentage >= 80 ? '#4c1' : ($percentage >= 60 ? '#dfb317' : '#e05d44');
$svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="126" height="20" role="img" aria-label="coverage: {$percentage}%">
  <title>coverage: {$percentage}%</title>
  <rect width="126" height="20" rx="3" fill="#555"/>
  <path fill="{$color}" d="M63 0h60a3 3 0 0 1 3 3v14a3 3 0 0 1-3 3H63z"/>
  <g fill="#fff" text-anchor="middle" font-family="Verdana, sans-serif" font-size="11">
    <text x="32" y="14">coverage</text><text x="94" y="14">{$percentage}%</text>
  </g>
</svg>
SVG;

$directory = dirname($destination);
if (! is_dir($directory) && ! mkdir($directory, 0775, true)) {
    exit(1);
}
exit(file_put_contents($destination, $svg) === false ? 1 : 0);
