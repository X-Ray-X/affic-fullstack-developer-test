<?php

namespace App\Libraries\Integrations;

use App\Libraries\Integrations\Transformers\Pms1RequestTransformer;
use App\Libraries\Integrations\Transformers\Pms2RequestTransformer;

class RequestTransformerFactory
{
    /**
     * @param string $vendor
     * @param $requestData
     * @return array
     * @throws \Exception
     */
    public function transform(string $vendor, $requestData): array
    {
        return match ($vendor) {
            SchemaDictionary::VENDOR_PMS1 => (new Pms1RequestTransformer())->transform($requestData),
            SchemaDictionary::VENDOR_PMS2 => (new Pms2RequestTransformer())->transform((array)$requestData),
            default => throw new \Exception('Schema vendor not recognized.'),
        };
    }
}
