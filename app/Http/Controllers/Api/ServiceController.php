<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $services = ServiceResource::collection(Service::all());
        return $this->apiResponde($services,'ok',200);
    }
}
