<?php

namespace App\Http\Controllers;

use App\Helpers\HttpResponse;
use App\Repositories\RoomRepositoryInterface;
use App\Transformers\RoomIndexTransformer;
use App\Transformers\RoomTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    private RoomRepositoryInterface $roomRepository;

    /**
     * @param RoomRepositoryInterface $roomRepositoryInterface
     */
    public function __construct(RoomRepositoryInterface $roomRepositoryInterface)
    {
        $this->roomRepository = $roomRepositoryInterface;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $rooms = $this->roomRepository->getAll();

        return HttpResponse::withArray(
            Response::HTTP_OK,
            (new RoomIndexTransformer)
                ->transform($rooms)
                ->paginate(5)
                ->jsonSerialize());
    }

    /**
     * @param string $externalId
     * @return JsonResponse
     */
    public function get(string $externalId): JsonResponse
    {
        try {
            $room = $this->roomRepository->getRoomByExternalId($externalId);
        } catch (ModelNotFoundException $exception) {
            return HttpResponse::withArray(
                Response::HTTP_NOT_FOUND,
                ['error' => sprintf('A room with ID: %s does not exist in the database.', $externalId)]
            );
        }

        return HttpResponse::withArray(Response::HTTP_OK, (new RoomTransformer())->transform($room));
    }
}
