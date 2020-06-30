<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallTags.
 */
class AircallTags
{
    const BASE_ENDPOINT = 'tags';

    /** @var AircallClient */
    private $client;

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * List all Tags.
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
     * Retrieve a Tag.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->tagPath($id);

        return $this->client->get($path);
    }

    /**
     * Create a Tag.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function create(array $options)
    {
        return $this->client->post(self::BASE_ENDPOINT, $options);
    }

    /**
     * Update a Tag.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(int $id, array $options = [])
    {
        $path = $this->tagPath($id);

        return $this->client->post($path, $options);
    }

    /**
     * Delete a Tag.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        $path = $this->tagPath($id);

        return $this->client->get($path);
    }

    public function tagPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
