<?php

namespace App\EntityListener;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;


#[AsEntityListener(event: Events::prePersist, entity: Page::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Page::class)]
class PageEntityListener
{
    public function __construct(
        private readonly SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Page $conference, LifecycleEventArgs $event): void
    {
        $conference->computeSlug($this->slugger);
    }

    public function preUpdate(Page $conference, LifecycleEventArgs $event): void
    {
        $conference->computeSlug($this->slugger);
    }
}
