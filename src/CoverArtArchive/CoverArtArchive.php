<?php

/**
 * Cover Art Archive PHP library
 *
 * @license MIT
 */

namespace CoverArtArchive;

use Guzzle\Http\Client;

/**
 * Connect to the Cover Art Archive web service
 *
 * http://musicbrainz.org/doc/Cover_Art_Archive/API
 *
 * @link http://github.com/mikealmond/CoverArtArchive
 */
class CoverArtArchive
{

    const URL = 'http://coverartarchive.org';

    /**
     * Used as a flag on the getImages() method
     */
    const CHAIN = true;

    /**
     * Used as a flag on the getImages() method
     */
    const RETURN_IMAGES = false;

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
     * Retrieves an array of images based on a
     * Music Brainz ID
     *
     * @param string $mbid
     * @param bool   $chain A flag to change what the method returns. Defaults to
     *      true to return $this
     * @throws \CoverArtArchive\Exception
     * @return self|array
     */

    public function getImages($mbid, $chain = true)
    {
        if (!self::isValidMBID($mbid)) {
            throw new Exception('Invalid Music Brainz ID');
        }

        $response = $this->call('/release/' . $mbid);

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

        return ($chain == true) ? $this : $this->images;
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
    final private function call($path)
    {
        $client = new Client(self::URL);
        $request = $client->get($path);
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
