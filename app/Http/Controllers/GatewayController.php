<?php

namespace App\Http\Controllers;

use App\Services\Gateway;

class GatewayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __invoke(Gateway $gateway)
    {
        return $gateway->requestToService();
    }
}
