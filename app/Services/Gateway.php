<?php

namespace App\Services;

use App\Services\Microservice\AMicroservice;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;

class Gateway
{
    private AMicroservice $microservice;

    /** @var Application */
    private Application $app;


    public function __construct(Request $request, Application $app) {
        $this->app = $app;
        $this->microservice = $this->resolveMicroservice($request);
    }

    public static function getMicroservicesPrefixes(): array {
        return array_keys(config('microservices'));
    }

    public static function getRegExpFromMicroservicesPrefixes(): string {
        return implode('|', static::getMicroservicesPrefixes());
    }

    public function requestToService(): Response {
        return $this->microservice->request();
    }

    private function resolveMicroservice(Request $request): ?AMicroservice {
        $prefix = $request->microservice_name;

        foreach (config('microservices') as $name => $config) {
            if ($prefix === $name) {
                $this->app->singleton('AMicroservice', fn() => new $config['classname']($config, $request));

                return $this->app->AMicroservice;
            }
        }

        return null;
    }
}
