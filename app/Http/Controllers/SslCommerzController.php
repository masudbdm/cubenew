<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\CustomerDetail;
use App\Models\Menu;
use App\Models\MenuPage;
use App\Models\Page;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\PostCategory;
use App\Models\WebsiteParameter;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class SslCommerzController extends Controller
{

    public function pay(Request $request)
    {
        $post_data = [];

        $post_data['store_id']     = env('SSLC_STORE_ID');
        $post_data['store_passwd'] = env('SSLC_STORE_PASSWORD');
        $post_data['total_amount'] = (float) $request->amount;
        $post_data['currency']     = 'BDT';
        $post_data['tran_id']      = uniqid('DON_');

        // Callback URLs
        $post_data['success_url']  = route('ssl.success');
        $post_data['fail_url']     = route('ssl.fail');
        $post_data['cancel_url']   = route('ssl.cancel');

        // Customer info (mandatory)
        $post_data['cus_name']    = 'Donor';
        $post_data['cus_email']   = 'donor@test.com';
        $post_data['cus_phone']   = '01700000000';
        $post_data['cus_add1']    = 'Dhaka';
        $post_data['cus_city']    = 'Dhaka';
        $post_data['cus_country'] = 'Bangladesh';

        // Product & shipping
        $post_data['shipping_method']  = 'NO';
        $post_data['product_name']     = 'Donation';
        $post_data['product_category'] = 'Donation';
        $post_data['product_profile']  = 'non-physical-goods';

        $api_url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';

        // 🔁 CURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        // ✅ Redirect to Gateway
        if (isset($result['status']) && $result['status'] === 'SUCCESS') {
            return redirect()->away($result['GatewayPageURL']);
        }

        // ❌ Fail fallback
        return back()->with('error', $result['failedreason'] ?? 'Payment initialization failed');
    }




    public function success(Request $request)
    {
        // SSLCommerz থেকে আসা data
        $val_id = $request->input('val_id');
        $tran_id = $request->input('tran_id');

        if (!$val_id || !$tran_id) {
            return redirect('/')
                ->with('error', 'Invalid payment response');
        }

        // Validation URL
        $store_id = env('SSLC_STORE_ID');
        $store_passwd = env('SSLC_STORE_PASSWORD');

        $sandbox = env('SSLC_SANDBOX', true);

        $validation_url = $sandbox
            ? "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php"
            : "https://securepay.sslcommerz.com/validator/api/validationserverAPI.php";

        // API call
        $response = Http::get($validation_url, [
            'val_id' => $val_id,
            'store_id' => $store_id,
            'store_passwd' => $store_passwd,
            'format' => 'json',
        ]);

        if (!$response->ok()) {
            return redirect('/')
                ->with('error', 'Payment validation failed');
        }

        $data = $response->json();

        /**
         * IMPORTANT CHECKS
         */
        if (
            $data['status'] !== 'VALID' &&
            $data['status'] !== 'VALIDATED'
        ) {
            return redirect('/')
                ->with('error', 'Payment not valid');
        }

        // ✅ এখানে চাইলে DB save করবেন
        // Donation::create([...])

        return view('ssl.success', [
            'transaction_id' => $tran_id,
            'amount' => $data['amount'],
            'card_type' => $data['card_type'],
        ]);
    }


    public function fail(Request $request)
    {
        return view('ssl.fail');
    }

    public function cancel(Request $request)
    {
        return view('ssl.cancel');
    }


    
}
