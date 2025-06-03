<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\AddressType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $address = new City();
        $form = $this->createForm(AddressType::class, $address);
        
        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
