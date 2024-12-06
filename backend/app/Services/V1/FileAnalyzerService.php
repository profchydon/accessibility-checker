<?php

namespace App\Services\V1;

use DOMXPath;
use DOMDocument;
use App\Services\Contracts\FileAnalyzerInterface;

class FileAnalyzerService implements FileAnalyzerInterface
{
    /**
     * Analyze the HTML content for various accessibility issues.
     *
     * @param string $html The HTML content to analyze
     * @return array<string, mixed> An array containing the score and list of issues
     */
    public static function analyze(string $html): array
    {
        $issues = [];
        $score = 100;

        if (empty($html)) {
            return [
                'score' => 0,
                'issues' => ['HTML content is empty'],
            ];
        }

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);

        if (!$dom->loadHTML($html)) {
            libxml_clear_errors();
            return [
                'score' => 0,
                'issues' => ['Failed to load HTML content'],
            ];
        }

        libxml_clear_errors();
        $xpath = new DOMXPath($dom);

        $issues = array_merge($issues, self::imageAnalysis($xpath, $score));
        $issues = array_merge($issues, self::inputAnalysis($xpath, $score));
        $issues = array_merge($issues, self::linkAnalysis($xpath, $score));
        $issues = array_merge($issues, self::headingAnalysis($xpath, $score));
        $issues = array_merge($issues, self::videoAnalysis($xpath, $score));
        $issues = array_merge($issues, self::languageAnalysis($xpath, $score));

        return [
            'score' => max($score, 0),
            'issues' => $issues,
        ];
    }

    private static function imageAnalysis(DOMXPath $xpath, int &$score): array
    {
        $imgErrors = $xpath->query("//img[not(@alt)]");
        $issues = [];

        if ($imgErrors->length > 0) {

            $score -= $imgErrors->length;

            foreach ($imgErrors as $img) {
                $src = $img->getAttribute('src') ?: 'unknown source';
                $issues[] = [
                    'rule' => 'All img tags must contain alt text',
                    'details' => "Image with source '{$src}' is missing an alt attribute.",
                    'suggested_fix' => [
                        'message' => "Add an appropriate alt attribute to the <img> tag to describe its content.",
                        'example_fix' => "<img src=\"{$src}\" alt=\"Descriptive text here\">",
                    ],
                ];
            }
        }

        return $issues;
    }

    private static function inputAnalysis(DOMXPath $xpath, int &$score): array
    {
        $inputNodes = $xpath->query("//input[not(@id) or not(@type='hidden')]");
        $issues = [];

        foreach ($inputNodes as $input) {
            $id = $input->getAttribute('id');
            $label = $xpath->query("//label[@for='{$id}']");

            if ($label->length === 0) {
                $score -= 5;
                $issues[] = [
                    'rule' => 'All input fields must have a label associated',
                    'details' => "An input field is missing a proper label.",
                    'suggested_fix' => [
                        'message' => 'Add a label element associated with the input field.',
                        'example_fix' => '<label for="input-id">Label Text</label><input id="input-id">',
                    ],
                ];
            }
        }

        return $issues;
    }

    private static function linkAnalysis(DOMXPath $xpath, int &$score): array
    {
        $issues = [];
        $undescLinks = $xpath->query("//a[string-length(text()) = 0 and not(@aria-label)]");

        if ($undescLinks->length > 0) {
            $score -= $undescLinks->length * 2;
            foreach ($undescLinks as $link) {
                $issues[] = [
                    'rule' => 'All links must be descriptive',
                    'details' => "A link is missing descriptive text or aria-label.",
                    'suggested_fix' => [
                        'message' => 'Add descriptive text or an aria-label to the link.',
                        'example_fix' => '<a href="link-url" aria-label="Descriptive label">Descriptive text</a>',
                    ],
                ];
            }
        }

        return $issues;
    }

    private static function headingAnalysis(DOMXPath $xpath, int &$score): array
    {
        $issues = [];
        $headings = $xpath->query("//h1 | //h2 | //h3 | //h4 | //h5 | //h6");
        $prevLevel = 0;

        foreach ($headings as $heading) {
            $level = (int)substr($heading->nodeName, 1);

            if ($level > $prevLevel + 1) {
                $score -= 3;
                $issues[] = [
                    'rule' => 'Headings must be hierarchical',
                    'details' => "Non-hierarchical heading found: <{$heading->nodeName}>.",
                    'suggested_fix' => [
                        'message' => 'Ensure the heading levels follow a logical structure.',
                        'example_fix' => '<h1>Main Title</h1><h2>Subsection</h2>',
                    ],
                ];
            }

            $prevLevel = $level;
        }

        if ($headings->length === 0) {
            $score -= 5;
            $issues[] = [
                'rule' => 'Body tag must contain headings',
                'details' => "No headings found in the body tag.",
                'suggested_fix' => [
                    'message' => 'Add appropriate headings to structure the document.',
                ],
            ];
        }

        return $issues;
    }

    private static function videoAnalysis(DOMXPath $xpath, int &$score): array
    {
        $issues = [];
        $videos = $xpath->query("//video[not(@controls) or not(@track)]");

        if ($videos->length > 0) {
            $score -= $videos->length * 5;
            foreach ($videos as $video) {
                $issues[] = [
                    'rule' => 'All videos must have captions, transcriptions, and controls',
                    'details' => "A video is missing captions, transcription, or controls.",
                    'suggested_fix' => [
                        'message' => 'Ensure the video element includes controls and captions.',
                        'example_fix' => '<video controls><track src="captions.vtt" kind="subtitles"></video>',
                    ],
                ];
            }
        }

        return $issues;
    }

    private static function languageAnalysis(DOMXPath $xpath, int &$score): array
    {
        $issues = [];
        $html = $xpath->query("//html[not(@lang)]");

        if ($html->length > 0) {
            $score -= 5;
            $issues[] = [
                'rule' => 'HTML must have a lang attribute',
                'details' => "The <html> tag is missing the lang attribute.",
                'suggested_fix' => [
                    'message' => 'Add a lang attribute to the HTML tag.',
                    'example_fix' => '<html lang="en">',
                ],
            ];
        }

        return $issues;
    }
}
