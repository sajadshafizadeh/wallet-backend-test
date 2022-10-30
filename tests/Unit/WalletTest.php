<?php

namespace Tests\Unit;

use App\Models\Wallet;
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

    public function test_add_money_to_user_wallet_that_not_exists()
    {
        $response = $this->post('api/user/wallet/add-money', [
            'user_id' => 10,
            'amount'  => 34000,
            'type'    => 'deposit'
        ]);

        $response->assertStatus(400);
    }

    public function test_add_money_to_user_wallet_insert_deposit()
    {
        $userId = 1;
        $amount = 34000;
        $this->post('api/user/wallet/add-money', [
            'user_id' => $userId,
            'amount'  => $amount,
            'type'    => 'deposit'
        ]);

        $lastInsert = Wallet::query()->where('user_id',$userId)->latest()->first();

        $this->assertEquals($amount,$lastInsert->amount);
    }

    public function test_add_money_to_user_wallet_insert_payment()
    {
        $userId = 1;
        $amount = 28000;
        $response = $this->post('api/user/wallet/add-money', [
            'user_id' => $userId,
            'amount'  => $amount,
            'type'    => 'payment'
        ]);

        $lastInsert = Wallet::query()->where('user_id', $userId)->where('tracking_code', $response['tracking_code'])->first();

        // The expected amout is "-28000", since the type is "payment", we expect for a negative number
        $this->assertEquals(((-1) * $amount), $lastInsert->amount);
    }

    public function test_add_money_to_user_wallet_insert_success()
    {
        $userId = 1;
        $response = $this->post('api/user/wallet/add-money', [
            'user_id' => $userId,
            'amount'  => 28000,
            'type'    => 'payment'
        ]);

        $response->assertStatus(200);
    }


}
