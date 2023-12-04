<?php

namespace App\Controller;

use App\Entity\Toys;
use App\Form\ToysType;
use App\Repository\ToysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/toys')]
class ToysController extends AbstractController
{
    #[Route('/', name: 'app_toys_index', methods: ['GET'])]
    public function index(ToysRepository $toysRepository): Response
    {
        return $this->render('toys/index.html.twig', [
            'toys' => $toysRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_toys_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SluggerInterface $s): Response
    {
        $toy = new Toys();
        $form = $this->createForm(ToysType::class, $toy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('ifile')->getData();
            if($imgFile){
                //upload img to folder
                $newFileName = $this->uploadImage($imgFile,$s);
                $toy->setImage($newFileName);

            }

            $created = $toy-> getCreated();

            if($created== null){
                $created = new \DateTime(date('Y-m-d H:i'));
                $toy->setCreated($created);
            }
            $entityManager->persist($toy);
            $entityManager->flush();

            return $this->redirectToRoute('app_toys_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('toys/new.html.twig', [
            'toys' => $toy,
            'form' => $form,
        ]);
    }

    public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
        $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
        try {
            $imgFile->move(
                $this->getParameter('image_dir'),
                $newFilename
            );
        } catch (FileException $e) {
            echo $e;
        }
        return $newFilename;
    }




    #[Route('/{id}', name: 'app_toys_show', methods: ['GET'])]
    public function show(Toys $toy): Response
    {
        return $this->render('toys/show.html.twig', [
            'toy' => $toy,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_toys_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $s, Toys $toy): Response
    {
        $form = $this->createForm(ToysType::class, $toy);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form->get('ifile')->getData();
            if ($imgFile) {
                // Upload img to folder
                $newFileName = $this->uploadImage($imgFile, $s);
                $toy->setImage($newFileName);
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_toys_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('toys/edit.html.twig', [
            'toys' => $toy,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_toys_delete', methods: ['POST'])]
    public function delete(Request $request, Toys $toy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$toy->getId(), $request->request->get('_token'))) {
            $entityManager->remove($toy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_toys_index', [], Response::HTTP_SEE_OTHER);
    }
}

