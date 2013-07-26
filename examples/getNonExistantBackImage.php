<?php

use CoverArtArchive\CoverArt;
use Guzzle\Http\Client;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    $coverArt = new CoverArt('1e477f68-c407-4eae-ad01-518528cedc2c', new Client());

    /** @var $back \CoverArtArchive\CoverArtImage */
    $back = $coverArt->getBackImage();

    ?>
    <img src="<?= $back->getThumbnail('small') ?>"/>
    <img src="<?= $back->getThumbnail('large') ?>"/>
    <img src="<?= $back->getImage() ?>"/><br/>
<?php
} catch (Exception $e) {

    print $e->getMessage();
}
