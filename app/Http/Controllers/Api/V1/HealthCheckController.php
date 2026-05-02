<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;

class HealthCheckController extends ApiController
{
    public function __invoke()
    {
        return $this->success(
            data: ['environment' => app()->environment()],
            message: 'API está funcionando perfeitamente.',
            code: 200
        );
    }
}
