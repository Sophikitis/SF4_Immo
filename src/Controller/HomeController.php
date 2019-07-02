<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends  AbstractController {
    /**
     * @var PropertyRepository
     */
    private $repository;


    /**
     * HomeController constructor.
     * @param PropertyRepository $repository
     */
    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param PropertyRepository $property
     * @return Response
     */
    public function index(PropertyRepository $property, Request $request, PaginatorInterface $paginator): Response
    {
        $properties = $property->findLatest();

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $properties = $paginator->paginate($this->repository->findAllVisibleQuery($search),
                $request->query->getInt('page', 1),
                12
            );
            return $this->render('property/index.html.twig', [
                'properties' => $properties,
                'form'          => $form->createView()

            ]);
        }

        return $this->render('pages/home1.html.twig', [
            'properties' => $properties,
            'form'          => $form->createView()

        ]);
    }
}