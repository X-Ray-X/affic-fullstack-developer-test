<?php

namespace App\Transformers;

use App\Helpers\Collection;
use App\Models\Room;
use Illuminate\Database\Eloquent\Collection as BaseCollection;
use League\Fractal\TransformerAbstract;

class RoomIndexTransformer extends TransformerAbstract
{
    /**
     * @param BaseCollection $rooms
     * @return Collection
     */
    public function transform(BaseCollection $rooms): Collection
    {
        $transformed = [];

        /** @var Room $room */
        foreach ($rooms as $room) {
            $transformed[] = [
                'id' => $room->external_id,
                'name' => $room->name,
                'photo' => $room->photo,
            ];
        }

        return new Collection($transformed);
    }
}
