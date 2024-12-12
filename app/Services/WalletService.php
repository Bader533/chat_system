<?php

namespace App\Services;

use App\Models\Conversion;
use App\Models\Wallet;
use App\Models\Transaction;
use Exception;

class WalletService
{
    public function deposit($userId, $asset, $amount)
    {
        $wallet = Wallet::firstOrCreate(['user_id' => $userId]);
        $conversion = Conversion::where('type', $asset)->first();

        if (!in_array($asset, ['diamonds', 'gold', 'silver'])) {
            throw new Exception("الأصل غير صحيح.");
        }
        $totalDollar = ($amount / $conversion->quantity) * $conversion->dollar;

        $isSaved = Transaction::create([
            'wallet_id' => $wallet->id,
            'agency_id' => auth()->user()->id,
            'type' => 'Deposit',
            'asset' => $asset,
            'amount' => $amount,
            'dollar' => $totalDollar,
        ]);

        if ($isSaved) {
            $wallet->increment($asset, $amount);
        }

        return $wallet;
    }

    public function withdraw($userId, $asset, $amount)
    {
        $wallet = Wallet::where('user_id', $userId)->firstOrFail();

        if ($wallet[$asset] < $amount) {
            throw new Exception("الرصيد غير كافٍ.");
        }

        $wallet->decrement($asset, $amount);

        Transaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'Withdraw',
            'asset' => $asset,
            'amount' => $amount,
        ]);

        return $wallet;
    }
}
