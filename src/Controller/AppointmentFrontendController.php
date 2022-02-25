<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/appointment")
 */
class AppointmentFrontendController extends AbstractController
{
    /**
     * @Route("/", name="appointment_index")
     */
    public function index()
    {

        echo "<pre>";
        print_r(1111111111);
        exit;


        return $this->render('appointment_frontend/index.html.twig', [
            'controller_name' => 'AppointmentFrontendController',
        ]);
    }


}
