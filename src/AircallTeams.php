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

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieve a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->teamPath($id);

        return $this->client->get($path);
    }

    /**
     * Create a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create(array $options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT, $options);
    }

    /**
     * Delete a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        $path = $this->teamPath($id);

        return $this->client->delete($path);
    }

    /**
     * Add a User to a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addUser(int $teamId, int $userId)
    {
        $path = $this->teamPath($teamId);

        return $this->client->post($path.'/users/'.$userId);
    }

    /**
     * Remove a User from a Team.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function removeUser(int $teamId, int $userId)
    {
        $path = $this->teamPath($teamId);

        return $this->client->delete($path.'/users/'.$userId);
    }

    public function teamPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
