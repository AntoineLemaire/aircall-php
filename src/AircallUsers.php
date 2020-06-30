<?php

namespace Aircall;

/**
 * Class AircallUsers.
 *
 * @see http://developer.aircall.io/#user
 */
class AircallUsers
{
    const BASE_ENDPOINT = 'users';

    /** @var AircallClient */
    private $client;

    /**
     * AircallUsers constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Lists Users.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function list($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Retrieve a single User.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get($id)
    {
        $path = $this->userPath($id);

        return $this->client->get($path);
    }

    /**
     * Start an outbound call.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function calls($id, $options = [])
    {
        $path = $this->userPath($id);

        return $this->client->post($path.'/calls', $options);
    }

    /**
     * Dial a phone number in an agent's phone.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function dial($id, $options = [])
    {
        $path = $this->userPath($id);

        return $this->client->post($path.'/dial', $options);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function userPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
