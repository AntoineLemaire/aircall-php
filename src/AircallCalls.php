<?php

namespace Aircall;

/**
 * Class AircallCalls.
 *
 * @see http://developer.aircall.io/#call
 */
class AircallCalls
{
    const BASE_ENDPOINT = 'calls';

    /** @var AircallClient */
    private $client;

    /**
     * AircallCalls constructor.
     *
     * @param AircallClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Lists Calls.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getCalls()
    {
        return $this->client->get(self::BASE_ENDPOINT);
    }

    /**
     * Gets a single Call with their ID.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getCall($id)
    {
        $path = $this->callPath($id);

        return $this->client->get($path);
    }

    /**
     * Search Calls.
     *
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function searchCalls($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT.'/search', $options);
    }

    /**
     * Display a link in-app to the User who answered a specific Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function linkCall($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/link', $options);
    }

    /**
     * Transfer the Call to another user.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function transfertCall($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/transfers', $options);
    }

    /**
     * Delete the recording of a specific Call.
     *
     * @param int   $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function deleteRecordingCall($id)
    {
        $path = $this->callPath($id);

        return $this->client->delete($path.'/recording');
    }

    /**
     * Delete the voicemail of a specific Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function deleteVoicemailCall($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->delete($path.'/voicemail', $options);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function callPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
