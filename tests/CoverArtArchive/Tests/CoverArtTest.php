<?php

namespace CoverArtArchive\Tests;

use CoverArtArchive\CoverArt;

/**
 * @covers CoverArtArchive\CoverArt
 */
class CoverArtTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function MBIDProvider()
    {
        return array(
            array(true, '4dbf5678-7a31-406a-abbe-232f8ac2cd63'),
            array(true, '4dbf5678-7a31-406a-abbe-232f8ac2cd63'),
            array(false, '4dbf5678-7a314-06aabb-e232f-8ac2cd63'), // Invalid spacing
            array(false, '4dbf5678-7a31-406a-abbe-232f8az2cd63') // ‘z’ is an invalid character
        );
    }

    /**
     * @dataProvider MBIDProvider
     */
    public function testIsValidMBID($validation, $mbid)
    {
        $this->assertEquals($validation, CoverArt::isValidMBID($mbid));
    }
}
