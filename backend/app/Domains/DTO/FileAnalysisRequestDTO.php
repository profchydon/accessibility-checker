<?php

namespace App\Domains\DTO;

use Illuminate\Http\Request;
use App\Traits\DTOToArray;

final class FileAnalysisRequestDTO
{

    use DTOToArray;

    public string $htmlContent;

    public function __construct(string $htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }

    /**
     * Static method to instantiate DTO from a Request.
     */
    public static function fromRequest(Request $request): self
    {
        // Use 'file' as defined in the validation rules
        $uploadedFile = $request->file('file');

        // Check if the file is uploaded and readable
        if (!$uploadedFile || !$uploadedFile->isValid()) {
            throw new \RuntimeException("Uploaded file is invalid or missing.");
        }

        // Read the content of the HTML file
        $htmlContent = file_get_contents($uploadedFile->getPathname());

        return new self($htmlContent);
    }
}
