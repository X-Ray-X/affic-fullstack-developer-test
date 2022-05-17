<?php

namespace App\Transformers;

use Illuminate\Support\MessageBag;
use League\Fractal\TransformerAbstract;

class CallbackReportTransformer extends TransformerAbstract
{
    /**
     * @param MessageBag $report
     * @return array
     */
    public function transform(MessageBag $report): array
    {
        $transformed = [];

        foreach ($report->toArray() as $roomId => $message) {
            $transformed[$roomId] = $message[0];
        }

        return $transformed;
    }
}
