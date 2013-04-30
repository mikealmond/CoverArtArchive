# Cover Art Archive Web Service PHP library

This PHP library that allows you to easily access the Cover Art Archive API. Visit the [Cover Art Archive page](http://musicbrainz.org/doc/Cover_Art_Archive) for more information.

## Usage Example


```php
<?php
use CoverArtArchive\CoverArtArchive;

require __DIR__ . '/vendor/autoload.php';

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
```

## Requirements
PHP5 and [cURL extension](http://php.net/manual/en/book.curl.php).