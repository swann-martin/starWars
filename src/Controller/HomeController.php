<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {
    }
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {



        return $this->render('home/index.html.twig', [
            'personnages' => $this->starWarsApiService->getPersonnages(),
        ]);
    }

    #[Route('/personnage/{id}', name: 'app_personnage', requirements: ['id' => '\d+'])]
    public function personnage(int $id,): Response
    {
        return $this->render('home/personnage.html.twig', [
            'personnage' => $this->starWarsApiService->getPersonnage($id)
        ]);
    }
}
