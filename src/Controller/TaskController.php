<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/add', name: 'app_add_task')]
    public function addTask(): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        return $this->render('task/add_task.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'app_browse')]
    public function homepage(): Response
    {
        return $this->render('task/browse.html.twig');
    }
}
