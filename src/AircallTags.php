<?php

namespace Aircall;

/**
 * Class AircallTags.
 */
class AircallTags
{
    const BASE_ENDPOINT = 'tags';

    /** @var AircallClient */
    private $client;

    /**
     * AircallTags constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * List all Tags.
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
     * Retrieve a Tag.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get($id)
    {
        $path = $this->tagPath($id);

        return $this->client->get($path);
    }

    /**
     * Create a Tag.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function create($options)
    {
        return $this->client->post(self::BASE_ENDPOINT, $options);
    }

    /**
     * Update a Tag.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function update($id, $options)
    {
        $path = $this->tagPath($id);

        return $this->client->post($path, $options);
    }

    /**
     * Delete a Tag.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function delete($id)
    {
        $path = $this->tagPath($id);

        return $this->client->get($path);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function tagPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
