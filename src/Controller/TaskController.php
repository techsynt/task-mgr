<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController
{
    #[Route('/{number}')]
    public function homepage(string $number = null): Response
    {
        $title = $number;
        return new Response("hi\n".$number);
    }
}
