<?php

use CoverArtArchive\CoverArtArchive;

require dirname(__DIR__) . '/vendor/autoload.php';

$coverArt = new CoverArtArchive();

try {
    $images = $coverArt->getImages('1e477f68-c407-4eae-ad01-518528cedc2c', CoverArtArchive::RETURN_IMAGES);

    foreach ($images as $image) {
        ?>
        <img src="<?=$image->getThumbnail('small')?>" />
        <img src="<?=$image->getThumbnail('large')?>" />
        <img src="<?=$image->getImage()?>" /><br />
        <?php
    }

} catch (Exception $e) {

    print $e->getMessage();
}
