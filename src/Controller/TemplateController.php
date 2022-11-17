<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;


class TemplateController extends AbstractController
{
    /**
     * @Route("/template", name="template")
     */
    public function index(): Response
    {
        return $this->render('template/base-back.html.twig', ['controller_name' => 'TemplateController',]);
    }







 /**
     * @Route("/templatefront", name="templatefront")
     */
    public function indexfront(UserRepository $userRepository): Response
    {
        return $this->render('base-front.html.twig', [
            'controller_name' => 'TemplateController',
               'User' => $userRepository->createQueryBuilder('u')->select('u')->getQuery()->getResult()

        ]);
    }




























}
