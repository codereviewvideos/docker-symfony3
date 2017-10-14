<?php

// src/AppBundle/Service/CacheExample.php

namespace AppBundle\Service;

use Psr\Cache\CacheItemPoolInterface;

class CacheExample
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function get(string $key)
    {
        $cacheKey = md5($key);

        $cachedItem = $this->cache->getItem($cacheKey);

        if (false === $cachedItem->isHit()) {
            // imagine we do some expensive task here
            // such as calling a remote API
            // $expensiveValue = $this->injectedApiService->get("some-url/etc");
            $expensiveValue = rand(1,100);

            $cachedItem->set($cacheKey, $expensiveValue);
            $this->cache->save($cachedItem);
        }

        return $cachedItem->get();
    }

}
