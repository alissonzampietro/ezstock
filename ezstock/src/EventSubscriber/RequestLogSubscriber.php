<?php

namespace App\EventSubscriber;

use App\Service\RequestLogService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestLogSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private RequestLogService $requestLogger
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $this->requestLogger->logRequest($event->getRequest());
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $this->requestLogger->logRequest($event->getRequest(), $event->getResponse());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
