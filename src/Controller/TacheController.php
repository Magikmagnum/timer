<?php

namespace App\Controller;

use App\Service\TacheService; // Correction de l'importation de la classe TacheService
use Symfony\Component\Routing\Annotation\Route; // Utilisation de l'annotation Route correcte
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/tache')]
class TacheController
{
    #[Route('', name: 'create_tache')]
    public function createTache(TacheService $tacheService): JsonResponse
    {
        return $tacheService->create(
            [
                "titre" => 'Nouvelle Tâche',
                "description" => 'Description de la tâche',
                "echeanceAt" => new \DateTimeImmutable('2024-12-10 12:00:00')
            ]
        );
    }

    #[Route('/{id}', name: 'update_tache')]
    public function updateTache(int $id, TacheService $tacheService): JsonResponse // Typage de $id
    {
        return $tacheService->update(
            $id,
            [
                "titre" => 'Tâche mise à jour'
            ]
        );
    }
}