<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/platform")
 */
class PlatformController extends AbstractController
{
    /**
     * @Route("/", name="platform_index", methods={"GET"})
     */
    public function index(CommentsRepository $platformRepository): Response
    {
        return $this->render('platform/index.html.twig', [
            'platforms' => $platformRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="platform_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $platform = new Comments();
        $form = $this->createForm(CommentsType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($platform);
            $entityManager->flush();

            return $this->redirectToRoute('platform_index');
        }

        return $this->render('platform/new.html.twig', [
            'platform' => $platform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platform_show", methods={"GET"})
     */
    public function show(Comments $platform): Response
    {
        return $this->render('platform/show.html.twig', [
            'platform' => $platform,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="platform_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comments $platform): Response
    {
        $form = $this->createForm(CommentsType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('platform_index');
        }

        return $this->render('platform/edit.html.twig', [
            'platform' => $platform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="platform_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comments $platform): Response
    {
        if ($this->isCsrfTokenValid('delete'.$platform->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($platform);
            $entityManager->flush();
        }

        return $this->redirectToRoute('platform_index');
    }
}
