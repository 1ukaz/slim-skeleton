<?php

namespace Tests\Functional;

class ProfileTest extends BaseTestCase
{
    /**
     * Test that the profile/facebook/{existing-id} route returns error without ID
     */
    public function testGetProfileWithoutId()
    {
        $response = $this->runApp('GET', '/profile/facebook/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotContains('response', (string)$response->getBody());
        $this->assertContains('error', (string)$response->getBody());
        $this->assertArrayHasKey('code', json_decode($response->getBody(), true)['error']);
        $this->assertEquals(500, json_decode($response->getBody(), true)['status']);
    }

    /**
     * Test that the profile/facebook/{existing-id} route with required argument returns a profile
     */
    public function testGetProfileWithId()
    {
        $response = $this->runApp('GET', '/profile/facebook/67563683055');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('response', (string)$response->getBody());
        $this->assertArrayHasKey('id', json_decode($response->getBody(), true)['response']);
    }

    /**
     * Test that the profile/facebook/{existing-id} route with invalid argument returns error
     */
    public function testGetProfileWithInvalidId()
    {
        $response = $this->runApp('GET', '/profile/facebook/parameter');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotContains('response', (string)$response->getBody());
        $this->assertContains('error', (string)$response->getBody());
        $this->assertArrayHasKey('code', json_decode($response->getBody(), true)['error']);
        $this->assertEquals(500, json_decode($response->getBody(), true)['status']);
    }

    /**
     * Test that the profile/facebook/{existing-id} route won't accept a post request
     */
    public function testPostProfileNotAllowed()
    {
        $response = $this->runApp('POST', '/profile/facebook/67563683055', ['dummy' => 'data']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}
