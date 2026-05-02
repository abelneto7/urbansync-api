<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;

abstract class ApiController extends Controller
{
    use HttpResponses;
}
