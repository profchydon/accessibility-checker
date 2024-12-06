<?php

namespace App\Http\Controllers\V1;

use Exception;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyzerRequest;
use App\Services\V1\FileAnalyzerService;

class AccessibilityController extends Controller
{

   /**
     * AccessibilityController constructor.
     * @param FileAnalyzerService $fileAnalyzerService
     */
    public function __construct(
        private readonly FileAnalyzerService $fileAnalyzerService
    ) {
    }


    public function analyze(AnalyzerRequest $request)
    {

        try {

            // Retrieve the DTO
            $htmlDTO = $request->getFile();

            // $htmlDTO->toArray();

            // Pass the encapsulated HTML content to the service
            $result = $this->fileAnalyzerService->analyze($htmlDTO->htmlContent);

            return $this->response(Response::HTTP_OK, __('messages.success'), $result);


        } catch (Exception $exception) {

            Log::error('Analysis failed', $exception->getMessage());
            return $this->error(Response::HTTP_UNPROCESSABLE_ENTITY, __($exception->getMessage()));

        }

    }

}
