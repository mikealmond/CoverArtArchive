<?php

/**
 * Cover Art Archive PHP library
 *
 * @license MIT
 */

namespace CoverArtArchive;

use Guzzle\Http\ClientInterface;

/**
 * Connect to the Cover Art Archive web service
 *
 * http://musicbrainz.org/doc/Cover_Art_Archive/API
 *
 * @link http://github.com/mikealmond/CoverArtArchive
 */
class CoverArt
{

    const URL = 'http://coverartarchive.org';

    /**
     * Stores an array of CoverArtImage objects
     */
    public $images = array();

    /**
     * The CoverArtImage object for the front image
     */
    public $front;

    /**
     * The CoverArtImage object for the back image
     */
    public $back;

    /**
     * The CoverArtImage object for the back image
     */
    private $mbid;

    /**
     * The Guzzle client used to make cURL requests
     *
     * @var \Guzzle\Http\ClientInterface
     */
    private $client;

    /**
     * Retrieves an array of images based on a
     * Music Brainz ID
     *
     * @throws \InvalidArgumentException
     * @return array
     */
    public function __construct($mbid, ClientInterface $client)
    {
        $this->client = $client;

        $this->setMBID($mbid);
        $this->retrieveImages();
    }

    /**
     * Sets the MusicBrainzID
     */
    public function setMBID($mbid)
    {
        if (!self::isValidMBID($mbid)) {
            throw new \InvalidArgumentException('Invalid Music Brainz ID');
        }

        $this->mbid = $mbid;
    }

    /**
     * Returns an array of images
     *
     * @return array
     */
    public function getMBID()
    {
        return $this->mbid;
    }

    /**
     * Returns an array of images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Retrieves an array of images based on a
     * Music Brainz ID
     *
     * @return array
     */
    public function retrieveImages()
    {
        $response = $this->call('/release/' . $this->getMBID());

        if (isset($response['images'])) {
            foreach ($response['images'] as $image) {
                $img = new CoverArtImage($image);
                if ($image['front']) {
                    $this->front = $img;
                }
                if ($image['back']) {
                    $this->back = $img;
                }
                $this->images[] = $img;
            }
        }

        return $this;
    }

    /**
     * Returns the front image
     *
     * @throws \CoverArtArchive\Exception
     * @return \CoverArtArchive\CoverArtImage
     */
    public function getFrontImage()
    {
        if (null == $this->front) {
            throw new Exception('No front image was found');
        }

        return $this->front;
    }

    /**
     * Returns the back image
     *
     * @throws \CoverArtArchive\Exception
     * @return \CoverArtArchive\CoverArtImage
     */
    public function getBackImage()
    {
        if (null == $this->back) {
            throw new Exception('No back image was found');
        }

        return $this->back;
    }

    /**
     * Perform a cURL request based on a supplied path
     *
     * @param  string $path
     * @return array
     */
    private function call($path)
    {
        $this->client->setBaseUrl(self::URL);

        $request = $this->client->get($path);
        $request->setHeader('Accept', 'application/json');

        return $request->send()->json();
    }

    /**
     * Checks to see if a supplied MBID is a valid UUID
     *
     * @param  string $mbid
     * @return bool
     */
    public static function isValidMBID($mbid)
    {
        return preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $mbid);
    }

}
