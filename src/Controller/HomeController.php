<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;

    /**
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'home')]
    public function index()
    {
        $products = $this->entityManager->getRepository(Produit::class)->findByIsBest(1);
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
  /*      phpinfo();*/
/*dd($products);*/

        $mail=new Mail();
        $mail->send('laboutiquetest42@gmail.com', 'Carine VINAGRE','Mon premier message', 'Bonjour ,Carine');

        return $this->render('home/index.html.twig',
            [
                'products'=>$products,
                'headers'=>$headers
            ]);
    }
}
