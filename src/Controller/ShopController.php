<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Toys;
use App\Repository\CartRepository;
use App\Repository\ToysRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/shop')]
class ShopController extends AbstractController
{
    #[Route('/', name: 'shop_hp', methods: ['GET'])]
    public function index(ToysRepository $toysRepository): Response
    {
        return $this->render('shop/index.html.twig', [
            'toys' => $toysRepository->findAll(),
        ]);
    }

    #[Route('/buy/{id}', name: 'buy_product')]
    public function buy(int $id, Toys $product, EntityManagerInterface $entityManager, UserRepository $ur, CartRepository $cr): Response
    {
        
       
        $re = $cr->findByPid($id);//id,quan
        
        if (count($re)==0) {
            $cart = new Cart();
            $u = $ur->find(1);
            $cart->setCartItem($u);    
            $cart->setCtoyid($product);    
            $cart->setCquantity(1);        
            $entityManager->persist($cart);
            $entityManager->flush();
        }
        else {
            $cid = $re[0]['id'];
            $quan = $re[0]['cquantity'];
            $cart = $cr->find($cid);
            $cart->setCquantity($quan+1);
            $entityManager->persist($cart);
            $entityManager->flush();
        
        }


        return new RedirectResponse($this->generateUrl('app_cart_index'));
        // return $this->render('shop/test.html.twig', [
        //     're' => $re[0]
        // ]);
    }
    
}
