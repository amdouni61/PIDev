<?php

namespace App\Controller;



use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{ #[Route('/user', name: 'app_classroom')]
public function index(  $userrepo): Response
{
    $listuser = $userrepo ->  findAll() ;
    return $this->render('user/index.html.twig', [
        'user' =>  $listuser
    ]);
}
    #[Route('/userbyid/{id}', name: 'app_user_show')]
    public function getbyid(UserRepository $UserReposetory, $id): Response
    {
        $detailsuser = $UserReposetory -> find($id);
        return $this->render('user/_form.html.twig', [
            'details' => $detailsuser
        ]);
    }
    #[Route('/user/add', name: 'app_user_add')]
    public function add(ManagerRegistry $doctrine ,Request $req) : Response
    {
        $em=$doctrine -> getManager() ;
        $user = new User() ;
        $form = $this->createForm(UserType::class,$user) ;
        $form->handleRequest($req) ;
        if($form ->isSubmitted()){
            $em -> persist($user) ;
            $em -> flush() ;
            return $this->redirectToRoute('app_user') ;
        }
        return $this->renderForm('user/_form.html.twig',['form'=> $form]) ;
    }

    #[Route('/user/remove/{id}', name: 'app_user_delete')]
    public function remove(ManagerRegistry $doctrine, $id): Response
    {
        $em=$doctrine -> getManager() ;
        $user=   $doctrine ->getRepository(User::class)->find($id) ;
        $em -> remove($user) ;
        $em -> flush() ;
        return $this->redirectToRoute('app_user') ;
    }
    #[Route('/user/update/{id}', name: 'app_user_update')]
    public function update(ManagerRegistry $doctrine , $id , Request $req) : Response
    {
        $em=$doctrine -> getManager() ;
        $user =   $doctrine ->getRepository(User::class)->find($id) ;
        $form = $this->createForm(UserType::class,$user) ;
        $form->handleRequest($req) ;
        if($form ->isSubmitted()){
            $em -> persist($user) ;
            $em -> flush() ;
            return $this->redirectToRoute('app_user') ;

        }
        return $this->renderForm('user/_form.html.twig',['formuser'=> $form]) ;
    }
}
