<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class AircallWebhooks.
 */
class AircallWebhooks
{
    const BASE_ENDPOINT = 'webhooks';

    /** @var AircallClient */
    private $client;

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * List all Webhooks.
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
     * Create a Webhook.
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
     * Retrieve a Webhook.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->webhookPath($id);

        return $this->client->get($path);
    }

    /**
     * Delete a Webhook.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        $path = $this->webhookPath($id);

        return $this->client->delete($path);
    }

    /**
     * Update a Webhook.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(int $id, array $options = [])
    {
        $path = $this->webhookPath($id);

        return $this->client->post($path, $options);
    }

    public function webhookPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
