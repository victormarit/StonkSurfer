<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/utilisateur/session", name="ajoutSession")
     */
    public function session(Request $request): Response
    {
        $session = new Session();
        $form = $this ->createForm(SessionType::class,$session);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session = $form->getData();
            $session->setIdUtilisateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
        }

        return $this->render('dashboard_utilisateur/session.html.twig', [
            'sessionForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/utilisateur/sessions", name="listeSessions")
     */
    public function sessions(): Response
    {
        $sessions = $this->getDoctrine()
            ->getManager()
            ->getRepository(Session::class)
            ->findBy([
                'idUtilisateur' => $this->getUser()
            ]);

        return $this->render('dashboard_utilisateur/liste.html.twig', [
            'sessions' => $sessions
        ]);
    }

    /**
     * @Route("/utilisateur/sessions/{id}", name="sessionId")
     */
    public function sessionId(int $id,Request $request): Response
    {
        $sessions = $this->getDoctrine()
            ->getManager()
            ->getRepository(Session::class)
            ->findBy([
                'idUtilisateur' => $this->getUser(),
                'id' => $id
            ]);
        $form = $this ->createForm(SessionType::class,$sessions[0]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session = $form->getData();
            $session->setIdUtilisateur($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
        }

        return $this->render('dashboard_utilisateur/sessionseul.html.twig', [
            'sessions' => $sessions,
            'sessionForm' => $form->createView()
        ]);
    }
}
