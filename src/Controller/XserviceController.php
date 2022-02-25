<?php

namespace App\Controller;

use App\Entity\Xservice;
use App\Form\XserviceType;
use App\Repository\XserviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/xservice")
 */
class XserviceController extends AbstractController
{
    /**
     * @Route("/", name="xservice_index", methods={"GET"})
     */
    public function index(XserviceRepository $xserviceRepository): Response
    {
        return $this->render('xservice/index.html.twig', [
            'xservices' => $xserviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="xservice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $xservice = new Xservice();
        $form = $this->createForm(XserviceType::class, $xservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($xservice);
            $entityManager->flush();

            return $this->redirectToRoute('xservice_index');
        }

        return $this->render('xservice/new.html.twig', [
            'xservice' => $xservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="xservice_show", methods={"GET"})
     */
    public function show(Xservice $xservice): Response
    {
        return $this->render('xservice/show.html.twig', [
            'xservice' => $xservice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="xservice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Xservice $xservice): Response
    {
        $form = $this->createForm(XserviceType::class, $xservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('xservice_index');
        }

        return $this->render('xservice/edit.html.twig', [
            'xservice' => $xservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="xservice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Xservice $xservice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$xservice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->remove($product);
            $xservice->setIsEnabled(false);
            $entityManager->persist($xservice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('xservice_index');
    }
}
