<?php

namespace App\Libraries\Integrations\Transformers;

use App\Libraries\Integrations\SchemaDictionary;
use League\Fractal\TransformerAbstract;

class Pms1RequestTransformer extends TransformerAbstract
{
    /**
     * @param array $requestData
     * @return array
     */
    public function transform(array $requestData): array
    {
        $transformed = [];

        foreach ($requestData as $room) {
            $transformed[] = [
                'external_id' => $room->id,
                'vendor' => SchemaDictionary::VENDOR_PMS1,
                'name' => $room->room->name,
                'size' => $room->room->capacity,
                'amenities' => $room->room->amenities,
                'hourly_rate' => $room->prices->hourly,
                'daily_rate' => $room->prices->daily,
                'photo' => $room->photo,
            ];
        }

        return $transformed;
    }
}
