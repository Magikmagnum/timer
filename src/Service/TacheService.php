<?php

namespace App\Service;

use App\Entity\Taches;
use App\Repository\TachesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TacheService extends AbstractController
{
    private $entityManager;
    private $tachesRepository;

    public function __construct(EntityManagerInterface $entityManager, TachesRepository $tachesRepository)
    {
        $this->entityManager = $entityManager;
        $this->tachesRepository = $tachesRepository;
    }


    /**
     * Met a jour une tache
     * 
     * @param int $id
     * @param array $tache
     * @return JsonResponse
     */
    public function create(array $tache_value): JsonResponse
    {
        return $this->JsonResponse(
            $this->save(
                new Taches(),
                $tache_value,
                true
            )
        );
    }

    /**
     * Met a jour une tache
     * 
     * @param int $id
     * @param array $tache
     * @return JsonResponse
     */
    public function update(int $id, array $tache_value): JsonResponse
    {
        if (!$tache = $this->tachesRepository->find($id))
            return new JsonResponse(
                ['message' => 'Tâche non trouvée'],
                404
            );

        return $this->JsonResponse(
            $this->save(
                $tache,
                ["titre" => 'Tâche mise à jour']
            )
        );
    }


    /**
     * Initialisation de l'entity Tache
     * 
     * @param Taches $tache
     * @param array $tache_value
     * @param bool $persist
     * @return Taches
     */
    private function save(Taches $tache, array $tache_value, bool $persist = false): Taches
    {
        isset($tache_value['titre']) && $tache->setTitre('Nouvelle Tâche');
        isset($tache_value['description']) && $tache->setDescription('Description de la tâche');
        isset($tache_value['echeanceAt']) && $tache->setEcheanceAt(new \DateTimeImmutable('2024-12-10 12:00:00'));

        $this->entityManager->persist($tache);
        $persist && $this->entityManager->flush();
        return $tache;
    }

    /**
     * Retourne une réponse JSON avec les données mises à jour
     * 
     * @param Taches $tache
     * @return JsonResponse
     */
    private function JsonResponse(Taches $tache): JsonResponse
    {
        return new JsonResponse([
            'id' => $tache->getId(),
            'titre' => $tache->getTitre(),
            'description' => $tache->getDescription(),
            'echeanceAt' => $tache->getEcheanceAt()->format('Y-m-d H:i:s'),
            'createdAt' => $tache->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $tache->getUpdatedAt() ? $tache->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ]);
    }
}