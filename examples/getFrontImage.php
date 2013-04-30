<?php

use CoverArtArchive\CoverArtArchive;

require dirname(__DIR__) . '/vendor/autoload.php';

$coverArt = new CoverArtArchive();

try {

    $front = $coverArt->getImages('1e477f68-c407-4eae-ad01-518528cedc2c')->getFrontImage();
    ?>
    <img src="<?=$front->getThumbnail('small')?>" />
    <img src="<?=$front->getThumbnail('large')?>" />
    <img src="<?=$front->getImage()?>" /><br />
    <?php

} catch (Exception $e) {

    print $e->getMessage();
}
