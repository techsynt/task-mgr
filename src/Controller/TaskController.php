<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/add', name: 'app_add_task', methods: 'GET')]
    public function addTask(): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        return $this->render('task/add_task.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/add', methods: 'POST')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $task->setOwner($this->getUser());
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager->persist($task);
            $entityManager->flush();

            return new RedirectResponse('/');
        }
        return $this->json('something went wrong');
    }

    #[Route('/', name: 'app_browse')]
    public function homepage(): Response
    {
        return $this->render('task/browse.html.twig');
    }

    #[Route('/dates', methods : 'GET')]
    public function dates()
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $tasks = $user->getTasks();
            $dates = [];
            foreach ($tasks as $task) {
                $dates[] = $task->getCreatedAt();
            }

            return $this->json($dates);
        }
    }
}
