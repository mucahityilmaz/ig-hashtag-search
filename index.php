<?php

/**
 * Creating a CSV file for instagram hashtag: "natural"
 * 
 * Just a quick solution due to lack of time
 * 
 * author   Mucahit Yilmaz
 * email    mucahityilmaz@gmail.com
 */

require __DIR__ . '/vendor/autoload.php';

$instagram = new \InstagramScraper\Instagram();
$medias = $instagram->getMediasByTag('natural',100);
// $medias = $instagram->getCurrentTopMediasByTagName('natural'); // just in case

usort($medias, fn($a, $b) => $a->getLikesCount() - $b->getLikesCount());

$fp = fopen('instagram_natural.csv', 'w');

$columns = array(
    'Id',
    'ShortCode',
    'CreatedTime',
    // 'Caption', // Can be unnecessarily long
    'CommentsCount',
    'LikesCount',
    'Link',
    // 'ImageHighResolutionUrl', // Can be unnecessarily long
    'Type',
);

fputcsv($fp, $columns);

foreach($medias as $media){
    $newLine = array(
        $media->getId(),
        $media->getShortCode(),
        $media->getCreatedTime(),
        // $media->getCaption(), // Can be unnecessarily long
        $media->getCommentsCount(),
        $media->getLikesCount(),
        $media->getLink(),
        // $media->getImageHighResolutionUrl(), // Can be unnecessarily long
        $media->getType(),
    );

    fputcsv($fp, $newLine);
}

fclose($fp);