<?php

declare(strict_types=1);

namespace Tests\functional\Infrastructure\UI\Http\Order;

use Tests\FunctionalTester;

class CreateOrderPostControllerCest
{
    private const ENDPOINT_URL = '/order';

    public function itShouldCreateAnOrder(FunctionalTester $I)
    {
        $I->wantTo('Given a request when is valid then create an Order and return 201');
        $order = $I->createRandomOrder();
        $client = $order->getClient();

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, [
            'order_id' => $order->getId()->getValue(),
            'client_id' => $client->getId()->getValue(),
        ]);

        $I->canSeeResponseCodeIs(201);
    }

    public function itShouldReturnBadRequestOnEmptyId(FunctionalTester $I)
    {
        $I->wantTo('Given an request when client id is empty then should return 400');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, [
            'order_id' => '',
            'client_id' => '',
        ]);

        $I->canSeeResponseCodeIs(400);
    }

    public function itShouldReturnBadRequestOnEmptyRequest(FunctionalTester $I)
    {
        $I->wantTo('Given an request when is empty then should return 400');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(self::ENDPOINT_URL, null);

        $I->canSeeResponseCodeIs(400);
    }
}
