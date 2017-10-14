<?php

namespace AppBundle\Controller;

use AppBundle\Service\CacheExample;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(CacheExample $cacheExample)
    {
        return $this->render('default/index.html.twig', [
            'result' => $cacheExample->get('some-value'),
        ]);
    }

}
