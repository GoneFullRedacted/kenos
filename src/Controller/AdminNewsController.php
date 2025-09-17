<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use App\Service\SlugService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormInterface;

#[Route('/admin/news')]
final class AdminNewsController extends AbstractController
{
    #[Route(name: 'app_admin_news_index', methods: ['GET'])]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('admin_news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, NewsRepository $newsRepository, SlugService $slugService): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('error', 'Le formulaire contient des erreurs :<br>'.$this->collectFormErrors($form));
            } else {
                try {
                    // Slug à partir du titre
                    $base = (string) $news->getTitle();
                    $slug = $slugService->fromText($base ?: 'news');
                    $slug = $slugService->makeUnique($slug, fn(string $s) => null !== $newsRepository->findOneBy(['slug' => $s]));
                    $news->setSlug($slug);

                    $entityManager->persist($news);
                    $entityManager->flush();

                    $this->addFlash('success', 'La news a été créée avec succès.');
                    return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
                } catch (UniqueConstraintViolationException $e) {
                    $this->addFlash('error', 'Contrainte d’unicité violée (slug/titre déjà utilisé).');
                } catch (\Throwable $e) {
                    $this->addFlash('error', 'Une erreur inattendue est survenue lors de l’enregistrement.');
                }
            }
        }

        return $this->render('admin_news/new.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('admin_news/show.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, News $news, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('error', 'Le formulaire contient des erreurs :<br>'.$this->collectFormErrors($form));
            } else {
                try {
                    // On ne modifie pas le slug si déjà présent (stabilité des URLs)
                    $entityManager->flush();
                    $this->addFlash('success', 'La news a été mise à jour.');
                    return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
                } catch (\Throwable $e) {
                    $this->addFlash('error', 'Une erreur inattendue est survenue lors de la mise à jour.');
                }
            }
        }

        return $this->render('admin_news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news, EntityManagerInterface $entityManager): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$news->getId(), $request->getPayload()->getString('_token'))) {
            $this->addFlash('error', 'Jeton CSRF invalide, suppression annulée.');
            return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
        }

        try {
            $entityManager->remove($news);
            $entityManager->flush();
            $this->addFlash('success', 'La news a été supprimée.');
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', "Impossible de supprimer : l'élément est référencé ailleurs.");
        } catch (\Throwable $e) {
            $this->addFlash('error', 'Une erreur inattendue est survenue lors de la suppression.');
        }

        return $this->redirectToRoute('app_admin_news_index', [], Response::HTTP_SEE_OTHER);
    }

    private function collectFormErrors(FormInterface $form): string
    {
        $errors = [];
        foreach ($form->getErrors(true) as $err) {
            $errors[] = $err->getMessage();
        }
        return $errors ? ('• '.implode('<br>• ', $errors)) : '';
    }
}
