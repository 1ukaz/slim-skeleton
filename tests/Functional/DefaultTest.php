<?php

namespace Tests\Functional;

class DefaultTest extends BaseTestCase
{
    /**
     * Test that the / route returns 200
     */
    public function testGetDefaultRootRoute()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('response', (string)$response->getBody());
        $this->assertArrayNotHasKey('id', json_decode($response->getBody(), true)['response']);
        $this->assertArrayHasKey('info', json_decode($response->getBody(), true)['response']);
        $this->assertArrayHasKey('hit', json_decode($response->getBody(), true)['response']);
        $this->assertArrayHasKey('usage', json_decode($response->getBody(), true)['response']);
    }

    /**
     * Test that the /[{slug}] returns 200
     */
    public function testGetDefaultRoute()
    {
        $response = $this->runApp('GET', '/slug');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayNotHasKey('id', json_decode($response->getBody(), true)['response']);
        $this->assertContains('response', (string)$response->getBody());
        $this->assertContains('/slug', (string)$response->getBody());
        $this->assertArrayHasKey('info', json_decode($response->getBody(), true)['response']);
        $this->assertArrayHasKey('hit', json_decode($response->getBody(), true)['response']);
        $this->assertArrayHasKey('usage', json_decode($response->getBody(), true)['response']);
    }

    /**
     * Test that the / route won't accept a post request
     */
    public function testPostDefaultNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['dummy' => 'data']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}
