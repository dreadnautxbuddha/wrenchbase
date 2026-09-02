<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HealthControllerTest extends WebTestCase
{
    #[DataProvider('endpointProvider')]
    public function testEndpointReturnsApiStatus(string $endpoint): void
    {
        $client = self::createClient();
        $client->request('GET', $endpoint);

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertJsonStringEqualsJsonString(
            '{"name":"Wrenchbase API","status":"ok"}',
            (string) $client->getResponse()->getContent(),
        );
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function endpointProvider(): iterable
    {
        yield 'index' => ['/'];
        yield 'health' => ['/health'];
    }
}
