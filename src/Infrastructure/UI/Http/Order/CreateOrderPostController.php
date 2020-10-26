<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Order;

use App\Application\Command\CommandBus;
use App\Application\Command\Order\CreateOrderCommand;
use App\Infrastructure\UI\Http\Middleware\RequestDeserializer;
use App\Infrastructure\UI\Http\Middleware\Validator\RequestValidator;
use App\Infrastructure\UI\Http\Order\Request\CreateOrderRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOrderPostController
{
    private RequestValidator $validator;
    private RequestDeserializer $serializer;
    private CommandBus $commandBus;

    public function __construct(RequestValidator $validator, RequestDeserializer $serializer, CommandBus $commandBus)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    public function execute(Request $request): JsonResponse
    {
        /** @var CreateOrderRequest $createOrderRequest */
        $createOrderRequest = $this->serializer->deserialize($request, CreateOrderRequest::class);
        $this->validator->validate($createOrderRequest);
        $this->commandBus->dispatch(new CreateOrderCommand(
            $createOrderRequest->getOrderId(),
            $createOrderRequest->getClientId()
        ));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
