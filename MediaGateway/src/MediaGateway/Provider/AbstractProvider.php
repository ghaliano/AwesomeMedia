<?php

namespace MediaGateway\Provider;

use MediaGateway\MediaItemNormalizerInterface;
use MediaGateway\MediaProviderInterface;
use MediaGateway\Query;

abstract class AbstractProvider implements MediaProviderInterface
{
    protected $normalizer;
    protected $client;

    public function __construct($client, MediaItemNormalizerInterface $normalizer = null)
    {
        $this->client = $client;
        $defaultNormalizer = 'MediaGateway\\Normalizer\\'.$this->guessName().'Normalizer';
        $this->normalizer = $normalizer ? $normalizer : new $defaultNormalizer();
    }

    public function setNormalizer(MediaOutputNormalizerInterface $rendrer)
    {
        $this->normalizer = $normalizer;

        return $this;
    }

    public function getNormalizer()
    {
        return $this->normalizer;
    }

    public function guessName()
    {
        $class = explode('\\', get_class($this));

        return str_replace('Provider', '', end($class));
    }
    
    /**
     * Search Media
     * 
     * @param  Query      $query
     * @return array
     */
    abstract public function search(Query $query);
    
    /**
     * Build Query
     * 
     * @param  Query      $query
     * @return string
     */    
    abstract public function buildQuery(Query $query);
}
