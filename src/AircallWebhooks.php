<?php

namespace Aircall;

/**
 * Class AircallWebhooks.
 */
class AircallWebhooks
{
    const BASE_ENDPOINT = 'webhooks';

    /** @var AircallClient */
    private $client;

    /**
     * AircallWebhooks constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * List all Webhooks.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getWebhooks($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Create a Webhook.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function create($options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT, $options);
    }

    /**
     * Retrieve a Webhook.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getWebhook($id)
    {
        $path = $this->webhookPath($id);

        return $this->client->get($path);
    }

    /**
     * Delete a Webhook.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function delete($id)
    {
        $path = $this->webhookPath($id);

        return $this->client->delete($path);
    }

    /**
     * Update a Webhook.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function update($id, $options = [])
    {
        $path = $this->webhookPath($id);

        return $this->client->post($path, $options);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function webhookPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
