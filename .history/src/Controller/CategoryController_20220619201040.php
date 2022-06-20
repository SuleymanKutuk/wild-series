<?php

namespace App\Controller;

use App\Entity\Category;


use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }


    #[Route('category_new', name: 'category_new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response

    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $categoryRepository->add($category, true);


            return $this->redirectToRoute('category_index');
        }

        return $this->renderForm(
            'category/new.html.twig',
            ['form' => $form,]
        );
    }





    #[Route('/category/{categoryName}', name: 'category_show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository)
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No program with name : ' . $categoryName . ' not found in categorys\'s table.'
            );
        }

        $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);

        return $this->render('category/show.html.twig', [
            'programs' => $programs,
            'category' => $category,


        ]);
    }
}