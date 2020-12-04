<?php

namespace App\Controller;

use App\Entity\Plage;
use App\Entity\Session;
use App\Entity\Spot;
use App\Form\SessionType;
use App\Form\SpotType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/spotResults", name="spot_results", methods={"POST"})
     */
    public function resultManagement(): Response
    {

        $splitTab = explode(',', $_POST["results"]);
        $lats = [];
        $longs = [];
        $count = 0;
        if ($_POST["results"] != "") {
            for ($i = 0; $i < count($splitTab); $i += 2) {
                $lats[$count] = $splitTab[$i];
                $longs[$count] = $splitTab[$i + 1];
                $count++;
            }

            $spots = $this->getDoctrine()->getRepository(Spot::class)->findBy(['latitude' => $lats, 'longitude' => $longs]);
            return $this->render("spot/resultManagement.html.twig", [
                "spots" => $spots
            ]);
        }
    }

    /**
     * @Route("/spotcreation", name="spotCreation")
     */
    public function creationSpot(Request $request): Response
    {

        $spot = new Spot();
        $form = $this ->createForm(SpotType::class,$spot);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $spot = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spot);
            $entityManager->flush();
        }
            return $this->render("spot/creation.html.twig", [
                "spotForm" => $form->createView()
            ]);
        }
}
