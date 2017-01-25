<?php

namespace Aircall;

/**
 * Class AircallContacts.
 *
 * @see http://developer.aircall.io/#call
 */
class AircallContacts
{
    const BASE_ENDPOINT = 'contacts';

    /** @var AircallClient */
    private $client;

    /**
     * AircallContacts constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Lists Contacts.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getContacts($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Gets a single Contact with their ID.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getContact($id, $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->get($path, $options);
    }

    /**
     * Creates a Contact.
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
     * Update data for a specific Contact.
     *
     * @param int|string $id
     * @param array      $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function update($id, $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path, $options);
    }

    /**
     * Delete a specific Contact.
     *
     * @param int|string $id
     * @param array      $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function delete($id, $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->delete($path, $options);
    }

    /**
     * Search Contacts.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function searchContacts($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT.'/search', $options);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function contactPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
