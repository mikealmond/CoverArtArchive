<?php

/**
 * Cover Art Archive PHP library
 *
 * @license MIT
 */

namespace CoverArtArchive;

/**
 * Represents a cover object.
 */
class CoverArtImage
{
    /**
     * Stores the image data
     */
    public $image = array();

    /**
     * @param array $image
     */
    public function __construct(array $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the file path to the requested image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image['image'];
    }

    /**
     * Returns the ID of the requested image
     *
     * @return string
     */
    public function getId()
    {
        return $this->image['id'];
    }

    /**
     * Returns the edit ID of the requested image
     *
     * @return int
     */
    public function getEditId()
    {
        return $this->image['edit'];
    }

    /**
     * Returns the file path to the requested thumbnail
     *
     * @param  string $size The requested thumbnail size
     *
     * @throws \InvalidArgumentException
     * @return string
     */
    public function getThumbnail($size = 'small')
    {
        if (!in_array($size, array('small', 'large'))) {
            throw new \InvalidArgumentException('You must enter either small or large in the getThumbnail() method');
        }

        return $this->image['thumbnails'][$size];
    }

    /**
     * Checks to see if the image is the front image
     *
     * @return bool
     */
    public function isFront()
    {
        return $this->image['front'];
    }

    /**
     * Checks to see if the image is the back image
     *
     * @return bool
     */
    public function isBack()
    {
        return $this->image['back'];
    }

    /**
     * Checks to see if the image has been approved
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->image['approved'];
    }

    /**
     * Returns the file path to the requested thumbnail
     *
     * @internal param string $size The requested thumbnail size
     * @return string
     */
    public function getTypes()
    {
        return $this->image['types'];
    }

    /**
     * Returns any comments on the image
     *
     * @return string
     */
    public function getComment()
    {
        return $this->image['comment'];
    }
}
