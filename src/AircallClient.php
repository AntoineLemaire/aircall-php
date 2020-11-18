<?php

namespace Aircall;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use stdClass;

class AircallClient
{
    const BASE_URI = 'api.aircall.io';

    /** @var Client */
    private $http_client;

    /** @var string API ID authentication */
    protected $apiID;

    /** @var string API token authentication */
    protected $apiToken;

    /** @var AircallCompany */
    public $company;

    /** @var AircallUsers */
    public $users;

    /** @var AircallNumbers */
    public $numbers;

    /** @var AircallCalls */
    public $calls;

    /** @var AircallContacts */
    public $contacts;

    /** @var AircallTags */
    public $tags;

    /** @var AircallTeams */
    public $teams;

    /**
     * @param string $apiID    app ID
     * @param string $apiToken api Token
     */
    public function __construct(string $apiID, string $apiToken)
    {
        $this->setDefaultClient();
        $this->company = new AircallCompany($this);
        $this->users = new AircallUsers($this);
        $this->numbers = new AircallNumbers($this);
        $this->calls = new AircallCalls($this);
        $this->contacts = new AircallContacts($this);
        $this->tags = new AircallTags($this);
        $this->teams = new AircallTeams($this);

        $this->apiID = $apiID;
        $this->apiToken = $apiToken;
    }

    private function setDefaultClient()
    {
        $this->http_client = new Client();
    }

    /**
     * Sets GuzzleHttp client.
     *
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->http_client = $client;
    }

    /**
     * Sends POST request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function post($endpoint, $datas = [])
    {
        $response = $this->http_client->request('POST', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function put($endpoint, $datas = [])
    {
        $response = $this->http_client->request('PUT', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Aircall API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($endpoint, $datas = [])
    {
        $response = $this->http_client->request('DELETE', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array  $$datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get($endpoint, $datas = [])
    {
        $response = $this->http_client->request('GET', $this->getUri().$endpoint, [
            'query' => $datas,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Returns next page of the result.
     *
     * @param stdClass $meta
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function nextPage($meta)
    {
        $response = $this->http_client->request('GET', $this->addAuthToUri($meta->next_page_link), [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Returns previous page of the result.
     *
     * @param stdClass $meta
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function previousPage($meta)
    {
        $response = $this->http_client->request('GET', $this->addAuthToUri($meta->previous_page_link), [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $this->handleResponse($response);
    }

    public function ping()
    {
        return $this->get('ping', []);
    }

    /**
     * Returns authentication parameters.
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->apiID.':'.$this->apiToken;
    }

    /**
     * Returns Aircall API Uri.
     *
     * @return string
     */
    public function getUri()
    {
        return 'https://'.$this->getAuth().'@'.self::BASE_URI.'/v1/';
    }

    /**
     * Add Authentitication parameters to an Aircall API Uri.
     *
     * @param $uri
     *
     * @return mixed
     */
    public function addAuthToUri($uri)
    {
        if (false !== $pos = strpos($uri, self::BASE_URI)) {
            return substr_replace($uri, $this->getAuth().'@', $pos, 0);
        }
        throw new InvalidArgumentException('uri is not an Aircall API Uri');
    }

    /**
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = Utils::streamFor($response->getBody());

        return json_decode($stream);
    }
}
