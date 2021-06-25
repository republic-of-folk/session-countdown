<?php

namespace Tests\Feature;

use Tests\TestCase;

class SiteTest extends TestCase
{
    public function test_homeViewExists()
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertViewIs('Site.countdown');
    }
}
