<?php

namespace App\Controller;

use App\Message\BaselinkerOrderFetchMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class BaselinkerController extends AbstractController
{
    private MessageBusInterface $messageBus;
    private array $allowedPlatforms = ['allegro', 'amazon'];

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function fetchOrders(string $platform): Response
    {
        if (!in_array($platform, $this->allowedPlatforms)) {
            return new JsonResponse(['error' => 'Platform not allowed.'], Response::HTTP_NOT_FOUND);
        }

        try {
            $this->messageBus->dispatch(new BaselinkerOrderFetchMessage($platform));

            $responseMessage = 'Orders fetching request sent to the queue.';
            $statusCode = Response::HTTP_ACCEPTED;
        } catch (\Exception $e) {
            $responseMessage = 'Error while processing the request: ' . $e->getMessage();
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return new JsonResponse(['message' => $responseMessage], $statusCode);
    }
}
