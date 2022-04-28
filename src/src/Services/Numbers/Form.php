<?php

namespace App\Services\Numbers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Form extends AbstractController
{

    public function index(): Response
    {
        return $this->render('form/numbers.html.twig');
    }

}