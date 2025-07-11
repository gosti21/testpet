<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
/*    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    public function index()
    {
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token);


        return view('checkout.index', compact('session_token'));
    }
    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');

        $auth = Base64_encode($user . ':' . $password);

        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])
            ->get($url_api)
            ->body();
    }

    public function generateSessionToken($access_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => Cart::instance('shopping')->subtotal() + 5,
            'antifraud' => [
                'clientIp' => request()->ip(),
                'merchantDefineData' => [
                    'MDD4' => 'integraciones@niubiz.com.pe',
                    'MDD32' => 'JD1892639123',
                    'MDD75' => 'Registrado',
                    'MDD77' => 458,
                ]
            ],
            'dataMap' => [
                'cardholderCity' => 'Lima',
                'cardholderCountry' => 'PE',
                'cardholderAddress' => 'Av Jose Pardo 831',
                'cardholderPostalCode' => '12345',
                'cardholderState' => 'LIM',
                'cardholderPhoneNumber' => '987654321'
            ]
        ])->json();

        if (isset($response['sessionKey'])) {
            return $response['sessionKey'];
        }

        logger()->error('Error al generar sessionKey', ['response' => $response]);
        abort(500, 'No se pudo generar sessionKey.');
    }

    public function paid(Request $request)
    {

        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            "channel" => "web",
            "captureType" => "manual",
            "countable" => true,
            "order" => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchasenumber, //reparalo
                "amount" => $request->amount,
                "currency" => "PEN",
            ]
        ])->json();

        session()->flash('niubiz', [
            'response' => $response,
            "purchaseNumber" => $request->purchasenumber, //reparalo
        ]);

        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {

            $address = Address::where('user_id', Auth::id())
                ->where('default', true)
                ->first();

            Order::create([
                'user_id' => Auth::id(),
                'content' => Cart::instance('shopping')->content(),
                'address' => $address,
                'payment_id' => $response['dataMap']['TRANSACTION_ID'],
                'total' => Cart::subtotal(),
            ]);

            Cart::destroy();

            return redirect()->route('gracias');
        }

        return redirect()->route('checkout.index');
    }
}
