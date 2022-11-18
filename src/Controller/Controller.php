<?php
// src/Controller/Controller.php
namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\User;
use App\Entity\Article;


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

    /**
     * @Route("/addArticle", name="addArticle")
     */
    public function addArticle(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
 
        $user = $this->getUser();

        return $this->render('addArticle.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/addOneArticle", name="app_addArticle")
     */
    public function addOneArticle(ManagerRegistry $doctrine): Response
    {
        if(isset($_POST['cheakMedia']) && $_POST['cheakMedia'] == 'Yes') 
        {
            $media = true;
        }else{
            $media = false;
        }
        $entityManager = $doctrine->getManager();

        $article = new Article();
        $article->setTitre($_POST['titre']);
        $article->setDescription($_POST['description']);
        $article->setMedia($media);

        $entityManager->persist($article);
        $entityManager->flush();


        $user = $this->getUser();

        return $this->render('addArticle.html.twig', [
            'user' => $user,
        ]);
    }

}