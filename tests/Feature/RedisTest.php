<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisTest extends TestCase
{
    public function testPing()
    {
        $response = Redis::command("ping");
        self::assertEquals("PONG", $response);

        $response = Redis::ping();
        self::assertEquals("PONG", $response);
    }

    public function testString()
    {
        Redis::setex("name", 2, "Eko");
        $response = Redis::get("name");
        self::assertEquals("Eko", $response);

        sleep(5);

        $response = Redis::get("name");
        self::assertNull($response);
    }

    public function testList()
    {
        Redis::del("names");

        Redis::rpush("names", "Eko");
        Redis::rpush("names", "Kurniawan");
        Redis::rpush("names", "Khannedy");

        $response = Redis::lrange("names", 0, -1);
        self::assertEquals(["Eko", "Kurniawan", "Khannedy"], $response);

        self::assertEquals("Eko", Redis::lpop("names"));
        self::assertEquals("Kurniawan", Redis::lpop("names"));
        self::assertEquals("Khannedy", Redis::lpop("names"));

    }

    public function testSet()
    {
        Redis::del("names");

        Redis::sadd("names", "Eko");
        Redis::sadd("names", "Eko");
        Redis::sadd("names", "Kurniawan");
        Redis::sadd("names", "Kurniawan");
        Redis::sadd("names", "Khannedy");
        Redis::sadd("names", "Khannedy");

        $response = Redis::smembers("names");
        self::assertEquals(["Eko", "Kurniawan", "Khannedy"], $response);
    }

    public function testSortedSet()
    {

        Redis::del("names");

        Redis::zadd("names", 100, "Eko");
        Redis::zadd("names", 100, "Eko");
        Redis::zadd("names", 85, "Kurniawan");
        Redis::zadd("names", 85, "Kurniawan");
        Redis::zadd("names", 95, "Khannedy");
        Redis::zadd("names", 95, "Khannedy");

        $response = Redis::zrange("names", 0, -1);
        self::assertEquals(["Kurniawan", "Khannedy", "Eko"], $response);
    }


}
