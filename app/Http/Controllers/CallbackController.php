<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepositoryInterface;
use App\Transformers\CallbackReportTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @param RoomRepositoryInterface $roomRepository
     * @return JsonResponse
     */
    public function callback(Request $request, RoomRepositoryInterface $roomRepository): JsonResponse {
        $results = $roomRepository->createOrUpdateMany($request->input());

        return (new JsonResponse())->setStatusCode(Response::HTTP_OK)
            ->setData((new CallbackReportTransformer())
            ->transform($results));
    }
}
