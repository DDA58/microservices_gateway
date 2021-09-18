<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Response;

class GatewayController extends Controller
{
    /**
     * @param Gateway $gateway
     * @return Response
     */
    public function __invoke(Gateway $gateway): Response
    {
        return $gateway->requestToService();
    }
}
