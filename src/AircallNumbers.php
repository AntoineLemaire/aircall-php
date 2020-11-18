<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallNumbers.
 *
 * @see http://developer.aircall.io/#number
 */
class AircallNumbers
{
    const BASE_ENDPOINT = 'numbers';

    /** @var AircallClient */
    private $client;

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * Lists Numbers.
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
     * Retrieve a Number.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->numberPath($id);

        return $this->client->get($path);
    }

    /**
     * Update a single Number.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(int $id, array $options = [])
    {
        $path = $this->numberPath($id);

        return $this->client->put($path, $options);
    }

    public function numberPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
