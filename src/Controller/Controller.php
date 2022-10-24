<?php
// src/Controller/Controller.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\User;

class Controller extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
 
        $user = $this->getUser();

        return $this->render('accueil.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
 
        $user = $this->getUser();

        return $this->render('profil.html.twig', [
            'user' => $user,
        ]);
    }
}