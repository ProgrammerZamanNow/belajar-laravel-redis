<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheTest extends TestCase
{
    public function testCache()
    {
        Cache::put("name", "Eko", 2);
        Cache::put("country", "Indonesia", 2);

        $response = Cache::get("name");
        self::assertEquals("Eko", $response);
        $response = Cache::get("country");
        self::assertEquals("Indonesia", $response);

        sleep(5);

        $response = Cache::get("name");
        self::assertNull($response);
        $response = Cache::get("country");
        self::assertNull($response);
    }

}
