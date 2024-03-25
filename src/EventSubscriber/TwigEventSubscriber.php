<?php

namespace App\EventSubscriber;


use App\Repository\PageRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private PageRepository $pageRepository;

    public function __construct(Environment $twig, PageRepository $pageRepository)
    {
        $this->twig = $twig;
        $this->pageRepository = $pageRepository;
    }
    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('page', $this->pageRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
