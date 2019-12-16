<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class Weather
{
    /**
     * The HTTP client used to make requests.
     *
     * @var Client
     */
    protected $http;

    /**
     * The weather API key.
     *
     * @var string
     */
    protected $key;

    /**
     * The weather API endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Instantiate a new Weather instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->http = $client;
        $this->key = config('services.open_weather_map.key');
        $this->endpoint = config('services.open_weather_map.endpoint');
    }

    /**
     * Get the weather for a given city.
     *
     * @param string $city
     * @return array
     */
    public function getWeatherByCity($city)
    {
        $response = NULL;

        try {
            $response = $this->http->get($this->endpoint, [
                'query' => [
                    'q' => $city,
                    'appid' => $this->key,
                ],
            ]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        }

        $response_body = $response->getBody();
        $response_contents = $response_body->getContents();

        return json_decode($response_contents);
    }
}
