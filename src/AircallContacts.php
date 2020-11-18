<?php

namespace Aircall;

use GuzzleHttp\Exception\GuzzleException;

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

    public function __construct(AircallClient $client)
    {
        $this->client = $client;
    }

    /**
     * Lists Contacts.
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
     * Retrieve a single Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get(int $id)
    {
        $path = $this->contactPath($id);

        return $this->client->get($path);
    }

    /**
     * Creates a Contact.
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
     * Update data for a specific Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function update(int $id, array $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path, $options);
    }

    /**
     * Delete a specific Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        $path = $this->contactPath($id);

        return $this->client->delete($path);
    }

    /**
     * Search Contacts.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function search(array $options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT.'/search', $options);
    }

    /**
     * Add phone number to a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addPhoneNumber(int $id, array $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path.'/phone_details', $options);
    }

    /**
     * Update a phone number from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updatePhoneNumber(int $contactId, int $phoneNumberId, array $options = [])
    {
        $path = $this->contactPath($contactId);

        return $this->client->post($path.'/phone_details/'.$phoneNumberId, $options);
    }

    /**
     * Delete a Contact's phone number.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deletePhoneNumber(int $contactId, int $phoneNumberId)
    {
        return $this->client->delete(self::BASE_ENDPOINT.'/phone_details/'.$phoneNumberId);
    }

    /**
     * Add email to a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addEmail(int $id, array $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path.'/email_details', $options);
    }

    /**
     * Update an email from a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updateEmail(int $contactId, int $emailId, array $options = [])
    {
        $path = $this->contactPath($contactId);

        return $this->client->post($path.'/email_details/'.$emailId, $options);
    }

    /**
     * Delete an email form a Contact.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function deleteEmail(int $contactId, int $emailId)
    {
        return $this->client->delete(self::BASE_ENDPOINT.'/email_details/'.$emailId);
    }

    public function contactPath(int $id): string
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
