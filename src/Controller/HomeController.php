<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends  AbstractController {


    /**
     * @param PropertyRepository $property
     * @return Response
     */
    public function index(PropertyRepository $property): Response
    {
        $properties = $property->findLatest();


        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}