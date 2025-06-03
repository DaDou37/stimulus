<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\AddressType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/ajax/cities', name:'ajax')]
    public function getCities(Request $request, CityRepository $cityRepository): JsonResponse
    {
        $postalCode = $request->query->get('postalCode');
        $cities = $cityRepository->findBy(['postalCode' => $postalCode]);

        $data = array_map(fn($city) => [
            'id' => $city->getId(),
            'name' => $city->getName()
        ], $cities);
        return new JsonResponse($data);
    }
}
