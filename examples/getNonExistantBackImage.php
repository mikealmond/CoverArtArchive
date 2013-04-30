<?php

use CoverArtArchive\CoverArtArchive;

require dirname(__DIR__) . '/vendor/autoload.php';

$coverArt = new CoverArtArchive();

try {

    $back = $coverArt->getImages('1e477f68-c407-4eae-ad01-518528cedc2c')->getBackImage();
    ?>
    <img src="<?=$back->getThumbnail('small')?>" />
    <img src="<?=$back->getThumbnail('large')?>" />
    <img src="<?=$back->getImage()?>" /><br />
    <?php

} catch (Exception $e) {

    print $e->getMessage();
}
