<?php
namespace App\Controller\Admin;
use App\Entity\Option;
use App\Entity\Property;
use App\Entity\User;
use App\Form\PropertyType;
use App\Form\UserType;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;


class AdminUserController extends  AbstractController {
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminPropertyController constructor.
     * @param UserRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(UserRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/users", name="admin.users.index")
     */
    public function index ()
    {
        $users = $this->repository->findAll();
        return $this->render('admin/users/index.html.twig', compact('users'));
    }

    /**
     * @Route("/admin/users/new", name="admin.users.new")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);



       if($form->isSubmitted() && $form->isValid()){

           $password = $passwordEncoder->encodePassword($user, $user->getPassword());
           $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'create success');
            return $this->redirectToRoute('admin.users.index');
       }

        return $this->render('admin/users/new.html.twig',[
            'user' => $user,
            'form' => $form->createView()
        ]);
    }




    /**
     * @Route("/admin/user/{id}", name="admin.user.edit", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(User $user, Request $request): Response
    {

        $oldPass = $user->getPassword();
        $user->setPassword('');

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           if($request->get('oldPassword') === $oldPass){
                $this->em->flush();
                $this->addFlash('success', 'edit success');
                return $this->redirectToRoute('admin.property.index');
           }
            $this->addFlash('error', 'Old password not corresponding');
        }
        return $this->render('admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/user/{id}", name="admin.user.delete", methods="DELETE")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function delete(User $user, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))){
            $this->em->remove($user);
            $this->em->flush();
            $this->addFlash('success', 'delete success');
        }
        return $this->redirectToRoute('admin.users.index');
    }

}