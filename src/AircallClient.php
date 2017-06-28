<?php

namespace Aircall;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;

class AircallClient
{
    const BASE_URI = 'api.aircall.io';

    /** @var Client $http_client */
    private $http_client;

    /** @var string API ID authentication */
    protected $apiID;

    /** @var string API token authentication */
    protected $apiToken;

    /** @var AircallCompany $company */
    public $company;

    /** @var AircallUsers $users */
    public $users;

    /** @var AircallNumbers $numbers */
    public $numbers;

    /** @var AircallCalls $calls */
    public $calls;

    /** @var AircallContacts $contacts */
    public $contacts;

    public $options;

    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    /**
     * AircallClient constructor.
     *
     * @param string $apiID    app ID
     * @param string $apiToken api Token
     */
    public function __construct($apiID, $apiToken)
    {
        $this->setDefaultClient();
        $this->company = new AircallCompany($this);
        $this->users = new AircallUsers($this);
        $this->numbers = new AircallNumbers($this);
        $this->calls = new AircallCalls($this);
        $this->contacts = new AircallContacts($this);

        $this->apiID = $apiID;
        $this->apiToken = $apiToken;
        $this->options=[];
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @param \stdClass $meta
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @param \stdClass $meta
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
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
        throw new \InvalidArgumentException('uri is not an Aircall API Uri');
    }

    public function setOrder($order = 'asc'){
        if (!in_array($order, [
            self::ORDER_ASC,
            self::ORDER_DESC,
        ], true)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $order));
        }

        $this->addOption('order', $order);
        return $this;
    }

    public function setLimit($per_page = 50){
        if (!is_int($per_page)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $per_page));
        }
        $this->addOption('per_page', $per_page);
        return $this;
    }

    public function setFrom($unixTimestamp){
        if (!is_int($unixTimestamp)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $unixTimestamp));
        }
        $this->addOption('from', $unixTimestamp);
        return $this;
    }

    public function setTo($unixTimestamp){
        if (!is_int($unixTimestamp)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $unixTimestamp));
        }
        $this->addOption('to', $unixTimestamp);
        return $this;
    }

    public function setPhoneNumber($phone_number = 1){
        if (!is_int($phone_number)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $phone_number));
        }
        $this->addOption('phone_number', $phone_number);
        return $this;
    }

    public function setEmail($email = 1){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $email));
        }
        $this->addOption('email', $email);
        return $this;
    }

    public function setLink($url){
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $url));
        }
        $this->addOption('url', $url);
        return $this;
    }

    public function setPage($page = 1){
        if (!($page)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' is not valid.', $page));
        }
        $this->addOption('page', $page);
        return $this;
    }


    /**
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = stream_for($response->getBody());

        return json_decode($stream);
    }


    public function addOption($name, $default = null){
        if (array_key_exists($name, $this->options)) {
            throw new \InvalidArgumentException(sprintf('The option \'%s\' already exists.', $name));
        }
        $this->options[$name] = $default;
        return $this;
    }
}
