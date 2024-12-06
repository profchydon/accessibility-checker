<?php

namespace App\Services\Contracts;

interface FileAnalyzerInterface
{
    public static function analyze(string $html): array;
}
