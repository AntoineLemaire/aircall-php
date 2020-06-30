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
    public function list($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Retrieve a single Contact.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get($id)
    {
        $path = $this->contactPath($id);

        return $this->client->get($path);
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
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function delete($id)
    {
        $path = $this->contactPath($id);

        return $this->client->delete($path);
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
    public function search($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT.'/search', $options);
    }

    /**
     * Add phone number to a Contact.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function addPhoneNumber($id, $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path.'/phone_details', $options);
    }

    /**
     * Update a phone number from a Contact.
     *
     * @param int   $contactId
     * @param int   $phoneNumberId
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function updatePhoneNumber($contactId, $phoneNumberId, $options = [])
    {
        $path = $this->contactPath($contactId);

        return $this->client->post($path.'/phone_details/'.$phoneNumberId, $options);
    }

    /**
     * Delete a Contact's phone number.
     *
     * @param int   $contactId
     * @param int   $phoneNumberId
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function deletePhoneNumber($contactId, $phoneNumberId)
    {
        return $this->client->delete(self::BASE_ENDPOINT.'/phone_details/'.$phoneNumberId);
    }

    /**
     * Add email to a Contact.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function addEmail($id, $options = [])
    {
        $path = $this->contactPath($id);

        return $this->client->post($path.'/email_details', $options);
    }

    /**
     * Update an email from a Contact.
     *
     * @param int   $contactId
     * @param int   $emailId
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function updateEmail($contactId, $emailId, $options = [])
    {
        $path = $this->contactPath($contactId);

        return $this->client->post($path.'/email_details/'.$emailId, $options);
    }

    /**
     * Delete an email form a Contact.
     *
     * @param int   $contactId
     * @param int   $emailId
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function deleteEmail($contactId, $emailId)
    {
        return $this->client->delete(self::BASE_ENDPOINT.'/email_details/'.$emailId);
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
