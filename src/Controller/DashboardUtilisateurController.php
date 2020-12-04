<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardUtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur/", name="dashboard_utilisateur")
     */
    public function index(): Response
    {
        $sessions = $this->getDoctrine()
            ->getManager()
            ->getRepository(Session::class)
            ->findAll();
        return $this->render('dashboard_utilisateur/index.html.twig', [
            'sessions' => $sessions,
            'controller_name' => 'DashboardUtilisateurController',
        ]);
    }
}
