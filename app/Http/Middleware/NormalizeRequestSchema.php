<?php

namespace App\Http\Middleware;

use App\Libraries\Integrations\RequestTransformerFactory;
use App\Libraries\Integrations\SchemaDictionary;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Opis\JsonSchema\Validator;

class NormalizeRequestSchema
{
    /**
     * Handles JSON Schema validation and normalizes the request body based on the vendor's schema config.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Validator $validator */
        $validator = App::make(Validator::class);

        $data = json_decode($request->getContent());

        foreach (SchemaDictionary::MAP as $schema) {
            $result = $validator->validate($data, $schema['id']);

            if ($result->isValid()) {

                $request->replace((new RequestTransformerFactory())->transform($schema['vendor'], $data));

                return $next($request);
            }
        }

        return (new JsonResponse())->setStatusCode(Response::HTTP_BAD_REQUEST)->setData(['error' => 'JSON schema not recognized.']);
    }
}
