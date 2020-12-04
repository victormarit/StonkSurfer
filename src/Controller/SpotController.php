<?php

namespace App\Controller;

use App\Entity\Spot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpotController extends AbstractController
{
    /**
     * @Route("/getAllSpot", name="spot")
     */
    public function index(): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Spot::class)->findAllSpots();
        return $this->json($donnees);
    }
}
