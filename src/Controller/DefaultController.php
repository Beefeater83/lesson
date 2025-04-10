<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class DefaultController extends AbstractController
{
    #[Route('/', name: 'blog_default')]
    public function index(BlogRepository $blogRepository, EntityManagerInterface $em): Response
    {
        $blogs = $blogRepository->findAll();
        dd($blogs);
        $blog = (new Blog())
            ->setTitle("Title")
            ->setDescription("Description")
            ->setText("Text");

        $em->persist($blog);
        $em->flush();

        return $this->render('default/index.html.twig', []);
    }
}
