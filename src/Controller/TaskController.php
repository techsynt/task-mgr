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
    private $task;

    private function getTask(): Task
    {
        if (null === $this->task) {
            $this->task = new Task();
            $this->task->setOwner($this->getUser());
        }

        return $this->task;
    }

    private function returnForm(): \Symfony\Component\Form\FormInterface
    {
        return $this->createForm(TaskType::class, $this->getTask());
    }

    #[Route('/add', name: 'app_add_task', methods: 'GET')]
    public function addTask(): Response
    {
        return $this->render('task/add_task.html.twig', [
            'form' => $this->returnForm(),
        ]);
    }

    #[Route('/add', methods: 'POST')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->returnForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
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
}
