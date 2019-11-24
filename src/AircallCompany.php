<?php

namespace Aircall;

/**
 * Class AircallCompany.
 */
class AircallCompany
{
    const BASE_ENDPOINT = 'company';

    /** @var AircallClient */
    private $client;

    /**
     * AircallCompany constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Gets generic data about the account.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getCompany($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }
}
