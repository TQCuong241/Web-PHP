<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        $vnp_TmnCode   = config('vnpay.tmn_code');
        $vnp_HashSecret= config('vnpay.hash_secret');
        $vnp_Url       = config('vnpay.vnp_url');
        $vnp_ReturnUrl = config('vnpay.return_url');

        $amount = round(Auth::user()->cart->items->sum(function($item){
            return $item->quantity * $item->product->price;
        })) * 100;

        $vnp_Params = [
            'vnp_Version'       => '2.1.0',
            'vnp_TmnCode'       => $vnp_TmnCode,
            'vnp_Amount'        => $amount,
            'vnp_Command'       => 'pay',
            'vnp_CreateDate'    => Carbon::now()->format('YmdHis'),
            'vnp_CurrCode'      => 'VND',
            'vnp_IpAddr'        => $request->ip(),
            'vnp_Locale'        => 'vn',
            'vnp_OrderInfo'     => 'Thanh toan don hang: '.Auth::id(),
            'vnp_ReturnUrl'     => $vnp_ReturnUrl,
            'vnp_TxnRef'        => time(),  
        ];

        ksort($vnp_Params);
        $query = http_build_query($vnp_Params);
        $hashdata = urldecode($query);
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $paymentUrl = $vnp_Url . '?' . $query . '&vnp_SecureHash=' . $vnpSecureHash;

        return redirect()->to($paymentUrl);
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        $secureHash = $data['vnp_SecureHash'] ?? null;
        unset($data['vnp_SecureHash'], $data['vnp_SecureHashType']);

        ksort($data);
        $hashdata = urldecode(http_build_query($data));
        $calculatedHash = hash_hmac('sha512', $hashdata, config('vnpay.hash_secret'));

        if ($calculatedHash === $secureHash && $request->vnp_ResponseCode == '00') {

            return redirect()
                ->route('cart.index')
                ->with('success', 'Thanh toán thành công với VNPAY!');
        }

        return redirect()
            ->route('cart.index')
            ->with('error', 'Thanh toán không thành công: ' . ($request->vnp_ResponseCode ?? ''));
    }
}
