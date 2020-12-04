<?php

namespace App\Controller;

use App\Entity\Consommable;
use App\Form\ConsommableType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ConsumableController extends AbstractController
{
    /**
     * @Route("/utilisateur/consumable", name="consumable")
     */
    public function index(): Response
    {
        $consommables = $this->getDoctrine()
            ->getManager()
            ->getRepository(Consommable::class)
            ->findAll();
        return $this->render('consumable/index.html.twig', [
            'consommables' =>$consommables
        ]);
    }

    /**
     * @Route("/utilisateur/ajouterConsumable", name="ajouterConsumable")
     */
    public function ajouterConsumable(Request $request): Response
    {
        $consommable = new Consommable();
        $form = $this ->createForm(ConsommableType::class,$consommable);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $consommable = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consommable);
            $entityManager->flush();
        }

        return $this->render('consumable/ajouter.html.twig', [
            'consoForm' => $form->createView()

        ]);
    }
}
