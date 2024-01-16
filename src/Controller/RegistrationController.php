<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration', methods: 'GET')]
    public function registration(): Response
    {
        // creates registration form
        $form = $this->createForm(RegistrationType::class);

        return $this->render('registration/registration.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/registration', methods: 'POST')]
    public function add(EntityManagerInterface $entityManager,
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            // getting and hashing the password
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            // setting the hashed password to the User and saving User object to DB
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json('успешно зареган');
        }

        return $this->json('bad');
    }
}
