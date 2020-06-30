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
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function list($options)
    {
        return $this->client->get(self::BASE_ENDPOINT, $options);
    }

    /**
     * Retrieve a single Call.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get($id)
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
    public function search($options = [])
    {
        return $this->client->get(self::BASE_ENDPOINT.'/search', $options);
    }

    /**
     * Display a link in-app to the User who answered a specific Call.
     *
     * @deprecated since 2019-11-21 available on the Call object
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function link($id, $options = [])
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
    public function transfert($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/transfers', $options);
    }

    /**
     * Comment the Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function comment($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/comments', $options);
    }

    /**
     * Pause recording on a live Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function pauseRecording($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/pause_recording', $options);
    }

    /**
     * Resume recording on a live Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function resumeRecording($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/resume_recording', $options);
    }

    /**
     * Display custom informations during a Call in the Phone app.
     *
     * @deprecated since 2019-11-21 available on the Call object
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getMetadata($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/metadata', $options);
    }

    /**
     * Set the Tags for a specific Call.
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function setTags($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/tags', $options);
    }

    /**
     * Delete the recording of a specific Call.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function deleteRecording($id)
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
    public function deleteVoicemail($id, $options = [])
    {
        $path = $this->callPath($id);

        return $this->client->delete($path.'/voicemail', $options);
    }

    /**
     * Add Insight Cards display custom data to Agents in their Phone apps during ongoing Calls
     *
     * @param int   $id
     * @param array $options
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function addInsightCards($id, $options)
    {
        $path = $this->callPath($id);

        return $this->client->post($path.'/insight_cards', $options);
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
