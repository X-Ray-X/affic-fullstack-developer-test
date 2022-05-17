<?php

namespace App\Libraries\Integrations\Transformers;

use App\Libraries\Integrations\SchemaDictionary;
use League\Fractal\TransformerAbstract;

class Pms2RequestTransformer extends TransformerAbstract
{
    /**
     * @param array $requestData
     * @return array
     */
    public function transform(array $requestData): array
    {
        $transformed = [];

        foreach ($requestData['rooms'] as $roomId => $room) {
            $transformed[] = [
                'external_id' => $roomId,
                'vendor' => SchemaDictionary::VENDOR_PMS2,
                'name' => $room->room_name,
                'size' => $room->size,
                'amenities' => $this->replaceCodesWithAmenities($room->amenities, $requestData),
                'hourly_rate' => $room->hourly_rate,
                'daily_rate' => null,
                'photo' => $room->photo,
            ];
        }

        return $transformed;
    }

    /**
     * @param $amenitiesCodes
     * @param $requestData
     * @return array
     */
    private function replaceCodesWithAmenities($amenitiesCodes, $requestData): array
    {
        $amenities = [];

        foreach ($amenitiesCodes as $code) {
            $amenities[] = $requestData['amenities']->{$code}->name ?? null;
        }

        return array_filter($amenities);
    }
}
