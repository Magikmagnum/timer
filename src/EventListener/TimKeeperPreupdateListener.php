<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class TimKeeperPreupdateListener
{
    #[AsEventListener(event: LifecycleEventArgs::class)]
    public function preUpdate(LifecycleEventArgs $event): void
    {
        dd($event);

        $entity = $event->getObject();

        // Vérifie si l'entité possède une méthode `setUpdatedAt`
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}