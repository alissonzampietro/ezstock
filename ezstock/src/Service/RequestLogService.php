<?php

namespace App\Service;

use App\Entity\RequestLog;
use App\Repository\RequestLogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogService
{

    public function __construct(
        private RequestLogRepository $requestLogRepository
    ) {
    }

    public function logRequest(Request $request, ?Response $response = null): void
    {
        $log = new RequestLog();
        $log->setMethod($request->getMethod());
        $log->setUri($request->getRequestUri());
        $log->setHeaders($request->headers->all());
        $log->setBody($request->getContent());
        $log->setCreatedAt(new \DateTime());

        if ($response) {
            $log->setResponseStatus($response->getStatusCode());
            $log->setResponseContent($response->getContent());
        }

        $this->requestLogRepository->save($log);
    }
}
