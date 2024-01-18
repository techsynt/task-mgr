<?php

namespace App\Controller;

use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
//        if ($request->getSession()->get('error')) {
//            dd($request->getSession()->get('error'));
//        }

        return $this->render('security/login.html.twig', [
            'form' => $form,
            'error' => $request->getSession()->get('error'),
        ]);
    }
}
