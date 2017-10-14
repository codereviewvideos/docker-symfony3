<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $cacheKey = md5('123');

        $cachedItem = $this->get('cache.app')->getItem($cacheKey);

        if (false === $cachedItem->isHit()) {
            $cachedItem->set($cacheKey, 'some value');
            $this->get('cache.app')->save($cachedItem);
        }

        return $this->render('default/index.html.twig', [
            'cache' => [
                'hit' => $cachedItem->isHit(),
            ]
        ]);
    }
}
