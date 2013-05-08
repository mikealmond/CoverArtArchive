<?php

use CoverArtArchive\CoverArt;
use Guzzle\Http\Client;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    $coverArt = new CoverArt('1e477f68-c407-4eae-ad01-518528cedc2c', new Client());

    foreach ($coverArt->images as $image) {
        ?>
        <img src="<?=$image->getThumbnail('small')?>" />
        <img src="<?=$image->getThumbnail('large')?>" />
        <img src="<?=$image->getImage()?>" /><br />
        <?php
    }

} catch (Exception $e) {

    print $e->getMessage();
}
