<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class TimeKeeperPrepersisteListener
{
    #[AsEventListener(event: LifecycleEventArgs::class)]
    public function prePersite(LifecycleEventArgs $event): void
    {
        dd($event);

        $entity = $event->getObject();

        // Vérifie si l'entité possède une méthode `setCreatedAt`
        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }
}