<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallTeams.
 */
class AircallTeams
{
    const BASE_ENDPOINT = 'teams';

    /** @var AircallClient */
    private $client;

    /**
     * AircallTeams constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve a Team.
     *
     * @param int $id
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get($id)
    {
        $path = $this->teamPath($id);

        return $this->client->get($path);
    }

    /**
     * Create a Team.
     *
     * @param array $options
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create($options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT, $options);
    }

    /**
     * Delete a Team.
     *
     * @param int $id
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($id)
    {
        $path = $this->teamPath($id);

        return $this->client->delete($path);
    }

    /**
     * Add a User to a Team.
     *
     * @param int $teamId
     * @param int $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addUser($teamId, $userId)
    {
        $path = $this->teamPath($teamId);

        return $this->client->post($path.'/users/'.$userId);
    }

    /**
     * Remove a User from a Team.
     *
     * @param int $teamId
     * @param int $userId
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function removeUser($teamId, $userId)
    {
        $path = $this->teamPath($teamId);

        return $this->client->delete($path.'/users/'.$userId);
    }



    /**
     * @param $id
     *
     * @return string
     */
    public function teamPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
