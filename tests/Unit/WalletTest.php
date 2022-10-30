<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
//    use RefreshDatabase;

    public function test_get_balance_user_not_found()
    {
        // To simulate a non-existing user
        $response = $this->get('api/user/wallet/balance/55');
        $response->assertStatus(404);
    }

    public function test_get_balance()
    {
        $response = $this->get('api/user/wallet/balance/1');
        $response->assertStatus(200);
    }

}
