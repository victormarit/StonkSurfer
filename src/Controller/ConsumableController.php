<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsumableController extends AbstractController
{
    /**
     * @Route("/consumable", name="consumable")
     */
    public function index(): Response
    {
        return $this->render('consumable/index.html.twig', [
            'controller_name' => 'ConsumableController',
        ]);
    }
}
