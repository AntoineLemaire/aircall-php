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
    public function getUsers($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Gets a single User with their ID.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getUser($id)
    {
        $path = $this->userPath($id);

        return $this->client->get($path);
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
