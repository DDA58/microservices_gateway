<?php

namespace App\Services\Microservice;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class AMicroservice
{
    private array $config;
    protected Request $request;
    private Client $client;
    protected array $client_options = [];

    public function __construct(array $config, Request $request) {
        $this->config = $config;
        $this->request = $request;
        $this->client = new Client();

        $this->initOptions();
    }

    private function initOptions(): void {
        $headers = $this->request->headers->all();

        if (array_key_exists(0, $headers['content-length']) && empty(trim($headers['content-length'][0]))) {
            unset($headers['content-length']);
        }

        $this->client_options['headers'] = $headers;
        $this->client_options['body'] = $this->request->getContent();
    }

    public function request(): Response {
        $this->preRequest();

        try {
            $result = $this->client->request($this->request->getMethod(), $this->getUri(), $this->client_options);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            $result = $e->getResponse();
        } catch (\Throwable $t) {
            dd($t); // TODO remove
            throw new HttpException(500, 'Oops');
        }

        $this->afterRequest();

        return response($result->getBody()->getContents())->withHeaders($result->getHeaders());
    }

    protected function getUri(): string {
        $query = $this->request->getQueryString();

        return $this->config['host'].'/'.$this->request->microservice_name.'/'.$this->request->microservice_querystring.
            ($query === null ? '' : '?'.$query);
    }

    protected function preRequest(): void
    {

    }

    protected function afterRequest(): void
    {

    }
}
