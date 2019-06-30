<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends  AbstractController {


    /**
     * @param PropertyRepository $property
     * @return Response
     */
    public function index(PropertyRepository $property): Response
    {
        $properties = $property->findLatest();

        return $this->render('pages/home.html.twig', [
            'properties' => $properties,

        ]);
    }
}