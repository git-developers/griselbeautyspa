<?php

namespace App\Controller;

use App\Entity\XserviceCategory;
use App\Form\XserviceCategoryType;
use App\Repository\XserviceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/xservice/category")
 */
class XserviceCategoryController extends AbstractController
{
    /**
     * @Route("/", name="xservice_category_index", methods={"GET"})
     */
    public function index(XserviceCategoryRepository $xserviceCategoryRepository): Response
    {
        return $this->render('xservice_category/index.html.twig', [
            'xservice_categories' => $xserviceCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="xservice_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $xserviceCategory = new XserviceCategory();
        $form = $this->createForm(XserviceCategoryType::class, $xserviceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($xserviceCategory);
            $entityManager->flush();

            return $this->redirectToRoute('xservice_category_index');
        }

        return $this->render('xservice_category/new.html.twig', [
            'xservice_category' => $xserviceCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="xservice_category_show", methods={"GET"})
     */
    public function show(XserviceCategory $xserviceCategory): Response
    {
        return $this->render('xservice_category/show.html.twig', [
            'xservice_category' => $xserviceCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="xservice_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, XserviceCategory $xserviceCategory): Response
    {
        $form = $this->createForm(XserviceCategoryType::class, $xserviceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('xservice_category_index');
        }

        return $this->render('xservice_category/edit.html.twig', [
            'xservice_category' => $xserviceCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="xservice_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, XserviceCategory $xserviceCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$xserviceCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $sXerviceRepo = $entityManager->getRepository("App:Xservice");
            $isUsed = $sXerviceRepo->isServiceCategoryUsed($xserviceCategory->getId());

            if ($isUsed) {
                $this->addFlash('warning', "This category is being used by at least one product. Therefore it cannot be eliminated.");
                return $this->redirectToRoute('xservice_category_index');
            }

            $entityManager->remove($xserviceCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('xservice_category_index');
    }
}
