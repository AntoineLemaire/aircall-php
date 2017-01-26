<?php

namespace Aircall;

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

    /**
     * AircallNumbers constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Lists Numbers.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getNumbers()
    {
        return $this->client->get(self::BASE_ENDPOINT);
    }

    /**
     * Gets a single Number with their ID.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getNumber($id)
    {
        $path = $this->numberPath($id);

        return $this->client->get($path);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function numberPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
