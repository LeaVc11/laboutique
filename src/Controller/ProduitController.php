<?php

namespace App\Controller;

use App\Classe\Recherche;
use App\Entity\Produit;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{

    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/nos-produits', name: 'produits')]
    public function index(Request $request)
    {

        $recherche= new Recherche();

        $form=$this->createForm(RechercheType::class,$recherche);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $products = $this->entityManager->getRepository(Produit::class)->findWithRecherche($recherche);
           /* dd($recherche);*/
        }else{
            $products = $this->entityManager->getRepository(Produit::class)->findAll();
        }
        return $this->render('produit/index.html.twig',

            [
                'products' => $products,
                'form'=>$form->createView()
            ]);
    }


    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug)
    {

        $product = $this->entityManager->getRepository(Produit::class)->findOneBySlug($slug);
    /*    dd($products);*/

        if (!$product)
        {
            return $this->redirectToRoute('produits');
        }

        return $this->render('produit/show.html.twig',
            [
                'product' => $product
            ]);
    }
}
