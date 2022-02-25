<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profile;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/staff-member")
 */
class StaffMemberController extends AbstractController
{
    /**
     * @Route("/", name="staff_member_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('staff_member/index.html.twig', [
            'staffMembers' => $userRepository->findAllByProfile(Profile::STAFF_MEMBER),
        ]);
    }

    /**
     * @Route("/new", name="staff_member_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $profile = $entityManager->getRepository("App:Profile")->findOneByCode(Profile::STAFF_MEMBER);

            if (!$profile) {
                $this->addFlash('warning', "Not Staff Member profile found");
                return $this->redirectToRoute('staff_member_index');
            }

            $user->setProfile($profile);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('staff_member_index');
        }

        return $this->render('staff_member/new.html.twig', [
            'staffMember' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staff_member_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('staff_member/show.html.twig', [
            'staffMember' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="staff_member_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('staff_member_index');
        }

        return $this->render('staff_member/edit.html.twig', [
            'staffMember' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="staff_member_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('staff_member_index');
    }
}
