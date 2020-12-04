<?php

namespace App\Controller;

use App\Entity\Plage;
use App\Entity\Session;
use App\Entity\Spot;
use App\Entity\Utilisateur;
use App\Form\PlageType;
use App\Form\SpotType;
use App\Repository\SpotRepository;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $nbusers = count($this->getDoctrine()->getRepository(Utilisateur::class)->findAll());
        $nbpost = count($this->getDoctrine()->getRepository(Session::class)->findAll());
        $nbspot= count($this->getDoctrine()->getRepository(Spot::class)->findAll());
        $nbBeaches = count($this->getDoctrine()->getRepository(Plage::class)->findAll());
        return $this->render('admin/index.html.twig', [
            'nbUsers' => $nbusers,
            'nbPosts' => $nbpost,
            'nbSpots' => $nbspot,
            'nbBeaches' => $nbBeaches
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
            20//nombre d'élements par page
        );
        return $this->render('admin/manageUsers.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/modifierUtilisateur?id={id}", name="AdminUpdateUser")
     * @param Request $request
     * @return Response
     */
    public function AdminUpdateUser(Request $request, PaginatorInterface $paginator, $id)
    {
        $user  = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['id'=> $id]);
        $role = $user->getRoles();
        if(count($role) > 1 )
        {
            $user->setRoles([]);
        }
        else{
            $user->setRoles(["ROLE_ADMIN"]);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $donnees  = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $users = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), //récupère le numéro de la page en cours et si on en a pas on récupère
            20//nombre d'élements par page
        );
        return $this->render('admin/manageUsers.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/supprimerUtilisateur?id={id}", name="AdminDelUser")
     * @param Request $request
     * @return Response
     */
    public function AdminDelUser(Request $request, PaginatorInterface $paginator, $id)
    {

        $user  = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(['id'=> $id]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute("manageUser");
    }

    /**
     * @Route("/admin/gestionSpots", name="manageSpots")
     * @param Request $request
     * @return Response
     */
    public function manageSpots(Request $request, PaginatorInterface $paginator)
    {
        $donnees  = $this->getDoctrine()->getRepository(Spot::class)->findAll();
        $spot = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), //récupère le numéro de la page en cours et si on en a pas on récupère
            20//nombre d'élements par page
        );
        return $this->render('admin/manageSpots.html.twig', [
            'spots' => $spot,
            ]);

    }


    /**
     * @Route("/admin/AdminModSpot?id={id}", name="AdminModSpot")
     * @param Request $request
     * @return Response
     */
    public function ModSpots(Request $request, $id)
    {
        $spot = $this->getDoctrine()->getRepository(Spot::class)->findOneBy(['id' => $id]);
        $form =  $this->createForm(SpotType::class, $spot);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($spot);
            $em->flush();
            return $this->redirectToRoute('manageBeachType');
        }

        return $this->render('admin/newSpot.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/AdminDelSpot?id={id}", name="AdminDelSpot")
     * @param Request $request
     * @return Response
     */
    public function DelSpots(Request $request, $id)
    {
        $spot  = $this->getDoctrine()->getRepository(Spot::class)->findOneBy(['id'=> $id]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($spot);
        $entityManager->flush();
        return $this->redirectToRoute("manageSpots");
    }



    /**
     * @Route("/admin/gestionTypeDePlage", name="manageBeachType")
     * @param Request $request
     * @return Response
     */
    public function manageBeachType(Request $request, PaginatorInterface $paginator)
    {
        $donnees  = $this->getDoctrine()->getRepository(Plage::class)->findAll();
        $beaches = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1), //récupère le numéro de la page en cours et si on en a pas on récupère
            20//nombre d'élements par page
        );
        return $this->render('admin/manageBeach.html.twig', [
            'beaches' => $beaches
        ]);
    }
    /**
     * @Route("/admin/supprimerTypePlage?id={id}", name="delBeach")
     * @param Request $request
     * @return Response
     */
    public function DelBeachType(Request $request, PaginatorInterface $paginator, $id)
    {
        $beach  = $this->getDoctrine()->getRepository(Plage::class)->findOneBy(['id'=> $id]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($beach);
        $entityManager->flush();

        return $this->redirectToRoute("manageBeachType");
    }
    /**
     * @Route("/admin/ajouterTypePlage", name="addBeach")
     * @param Request $request
     * @return Response
     */
    public function addBeach(Request $request):Response
    {
        $beach = new Plage();
        $form =  $this->createForm(PlageType::class, $beach);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($beach);
            $em->flush();
            return $this->redirectToRoute('manageBeachType');
        }

        return $this->render('admin/newBeachType.html.twig', [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/updateTypePlage?id={id}", name="updateBeach")
     * @param Request $request
     * @return Response
     */
    public function updateBeach(Request $request, $id):Response
    {
        $beach = $this->getDoctrine()->getRepository(Plage::class)->findOneBy(['id'=> $id]);;
        $form =  $this->createForm(PlageType::class, $beach);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($beach);
            $em->flush();
            return $this->redirectToRoute('manageBeachType');
        }

        return $this->render('admin/newBeachType.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
