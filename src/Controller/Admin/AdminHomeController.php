<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminHomeController extends  AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/", name="admin.home.index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}