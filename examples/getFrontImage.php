<?php

use CoverArtArchive\CoverArt;
use Guzzle\Http\Client;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    $coverArt = new CoverArt('1e477f68-c407-4eae-ad01-518528cedc2c', new Client());

    /** @var $front \CoverArtArchive\CoverArtImage */
    $front = $coverArt->getFrontImage();

    ?>
    <img src="<?= $front->getThumbnail('small') ?>"/>
    <img src="<?= $front->getThumbnail('large') ?>"/>
    <img src="<?= $front->getImage() ?>"/><br/>
<?php
} catch (Exception $e) {

    print $e->getMessage();
}
