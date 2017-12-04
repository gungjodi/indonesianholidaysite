<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->json('GET', '/');

        $response
            ->assertStatus(200);
    }

    public function testAPIHoliday()
    {
        $response = $this->json('GET', '/api/getEvent/2018-01-01');
        $data = array('isHoliday'=>1);
        $response->assertStatus(200)->assertJson($data);
    }

    public function testAPINotHoliday()
    {
        $response = $this->json('GET', '/api/getEvent/2018-01-02');
        $data = array('isHoliday'=>0);
        $response->assertStatus(200)->assertJson($data);
    }

    public function testAPIDateOutOfRange()
    {
        $response = $this->json('GET', '/api/getEvent/2017-01-02');
        $data = array('status'=>'OUT_OF_RANGE');
        $response->assertStatus(200)->assertJson($data);
    }
}
