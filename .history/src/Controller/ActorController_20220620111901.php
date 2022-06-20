<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Actor;



class ActorController extends AbstractController
{
    #[Route('/actor', name: 'app_actor')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/actor/{id}', name: 'actor_name', methods: ['GET'])]
    public function show(Actor $actor): Response
    {

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}