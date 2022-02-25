<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class FrontendController extends AbstractController
{
    /**
     * @Route("", name="frontend_index")
     */
    public function index()
    {


        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
        ]);
    }


}
