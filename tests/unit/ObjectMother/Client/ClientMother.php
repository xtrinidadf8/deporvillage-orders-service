<?php

declare(strict_types=1);

namespace Tests\unit\ObjectMother\Client;

use App\Domain\Client\Client;
use Faker\Factory;
use Tests\unit\ObjectMother\Client\ValueObject\ClientIdMother;

class ClientMother
{
    public static function random(): Client
    {
        $faker = Factory::create();
        $email = $faker->email;

        return new Client(
            ClientIdMother::random(),
            $email
        );
    }
}
