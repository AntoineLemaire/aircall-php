<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallCompany.
 */
class AircallCompany
{
    const BASE_ENDPOINT = 'company';

    /** @var AircallClient */
    private $client;

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * Gets generic data about the account.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(array $options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }
}
