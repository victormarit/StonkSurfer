<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Utilisateur;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $nbusers = count($this->getDoctrine()->getRepository(Utilisateur::class)->findAll());
        $nbpost = count($this->getDoctrine()->getRepository(Session::class)->findAll());
        return $this->render('admin/index.html.twig', [
            'nbUsers' => $nbusers,
        'nbPosts' => $nbpost
        ]);
    }

    /**
     * @Route("/admin/gestionUtilisateur", name="manageUser")
     * @param Request $request
     * @return Response
     */
    public function manageUser(Request $request, PaginatorInterface $paginator)
    {
        $donnees  = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $users = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), //récupère le numéro de la page en cours et si on en a pas on récupère
            1//nombre d'élements par page
        );
        return $this->render('admin/manageUsers.html.twig', [
            'users' => $users
        ]);
    }
}
