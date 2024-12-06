<?php

namespace App\Http\Requests;

use App\Domains\DTO\FileAnalysisRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

class AnalyzerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:html,htm',
        ];
    }

    /**
     * Convert the request to a FileAnalysisRequestDTO.
     */
    public function getFile(): FileAnalysisRequestDTO
    {
        // Use the DTO to encapsulate and validate the HTML data
        return FileAnalysisRequestDTO::fromRequest($this);
    }
}
