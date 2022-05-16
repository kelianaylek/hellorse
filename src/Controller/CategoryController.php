<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $filter = $request->query->get('filter');
        $category = $entityManager->getRepository(Category::class)->findBy(['name' => $filter]);
        $sizes = [];

        if(empty($category)){
            $products = $entityManager
                ->getRepository(Product::class)
                ->findAll();

            return $this->render('product/index.html.twig', [
                'products' => $products,
                'sizes' => $sizes
            ]);
        }

        $products = $category[0]->getProducts();
        if($filter === 'chaussures'){
            $sizes = ['38', '39', '40', '41', '42', '43','44','45','46',];
        }
        else if ($filter === 't-shirts'){
            $sizes = ['XS', 'S', 'M', 'L', 'XL'];
        }
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'sizes' => $sizes
        ]);
    }

    #[Route('/size', name: 'app_category_size', methods: ['GET'])]
    public function getBySize(EntityManagerInterface $entityManager, Request $request): Response
    {
        $size = $request->query->get('size');
        $products = $entityManager
            ->getRepository(Product::class)
            ->findBy(['size' => $size]);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'sizes' => []
        ]);
    }
}
