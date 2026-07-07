<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    use HttpResponses;

    public function __construct(private PermissionRepositoryInterface $repository)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(
            $this->repository->getAllGroupedByModule(),
            'Permissões recuperadas com sucesso.'
        );
    }
}
