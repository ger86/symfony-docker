<?php

namespace App\MessageHandler;

use App\Message\BaselinkerOrderFetchMessage;
use App\Baselinker\Service\BaselinkerServiceFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class BaselinkerOrderFetchHandler implements MessageHandlerInterface
{
    private BaselinkerServiceFactory $serviceFactory;

    public function __construct(BaselinkerServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    public function __invoke(BaselinkerOrderFetchMessage $message): array
    {
        $platform = $message->getPlatform();
        $service = $this->serviceFactory->createService($platform);

        $orders = $service->fetchOrders();

        // logika obsługi zamówień
        // ...

        return $orders;
    }
}
