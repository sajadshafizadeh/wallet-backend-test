<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class WalletController extends Controller
{
    public function getBalance(User $user)
    {
        $balance = Wallet::query()->where('user_id' ,$user->id)->sum('amount');

        return response()->json(['balance' => $balance],200);
    }

    public function addMoney(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'type' => 'required|in:deposit,withdraw,reward,payment'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $deposit = Wallet::query()->create(
            [
                'user_id' => $request->user_id,
                'amount' => DB::select("select wallet_type_sign($request->amount,'$request->type') as amount")[0]->amount,
                'type' => $request->type,
                'tracking_code' => $this->generateCode()
            ]);
        return response()->json(['tracking_code' => $deposit->tracking_code],200);
    }

    // 15 Digits
    private function generateCode()
    {
        return sprintf("%06d", mt_rand(1, 999999)) .  sprintf("%06d", mt_rand(1, 9999999));
    }

}
