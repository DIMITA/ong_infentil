<?php
namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\KKiapayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KKiapayWebhookController extends Controller
{
    public function handle(Request $request, KKiapayService $kkiapay)
    {
        $payload = $request->all();
        Log::info('KKiaPay webhook received', $payload);

        // Vérifier la signature
        $signature = $request->header('X-KKiapay-Signature', '');
        if (!$kkiapay->verifyWebhookSignature($payload, $signature)) {
            Log::warning('Invalid KKiaPay signature');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $transactionId = $payload['transactionId'] ?? $payload['transaction_id'] ?? null;
        $amount = $payload['amount'] ?? 0;
        $status = $payload['status'] ?? 'completed';
        $phone = $payload['clientPhone'] ?? $payload['phone'] ?? null;

        Donation::updateOrCreate(
            ['reference' => $transactionId],
            [
                'amount' => $amount / 100, // convert from centimes if needed
                'currency' => 'XOF',
                'donor_phone' => $phone,
                'status' => $status === 'SUCCESS' ? 'completed' : strtolower($status),
                'payment_method' => 'kkiapay',
                'transaction_id' => $transactionId,
                'raw_payload' => $payload,
            ]
        );

        return response()->json(['received' => true]);
    }
}
