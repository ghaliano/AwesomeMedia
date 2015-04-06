<?php

namespace MediaGateway\Normalizer;

use MediaGateway\MediaItemNormalizerInterface;
use MediaGateway\MediaProviderInterface;
use MediaGateway\Query;

class FlickrNormalizer implements MediaItemNormalizerInterface
{  
    public function normalize(array $result)
    {
        $normalized = [];
        foreach($result['query']['results']['photo'] as $item) {
            $flickr = new \MediaGateway\Model\Flickr();
            $flickr
                ->setRemoteId($item['id'])
                ->setTitle($item['title'])
            ;
            $normalized[] = $flickr;
        }

        return $normalized;
    }
}