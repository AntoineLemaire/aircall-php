<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

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

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * Lists Users.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function list(array $options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Retrieve a single User.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->userPath($id);

        return $this->client->get($path);
    }

    /**
     * Start an outbound call.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function calls(int $id, array $options = [])
    {
        $path = $this->userPath($id);

        return $this->client->post($path.'/calls', $options);
    }

    /**
     * Dial a phone number in an agent's phone.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function dial(int $id, array $options = [])
    {
        $path = $this->userPath($id);

        return $this->client->post($path.'/dial', $options);
    }

    public function userPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
