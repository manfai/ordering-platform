<?php

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // abort(404);
    return view('welcome');
})->name('welcome');

// Route::get('/terms-and-conditions', function () {
//     // abort(404);
//     return view('terms_and_conditions');
// })->name('t&c');

Route::get('/bentos', function () {
    return view('bentos');
})->name('bentos');

Route::get('/profile', function () {
    return view('orders');
})->name('profile');



Route::get('/faqs', function () {
    return view('pages.faqs');
})->name('faqs');

Route::get('/terms-and-conditions', function () {
    return view('pages.terms_and_conditions');
})->name('t&c');

Route::get('/privacy-policy', function () {
    return view('pages.policy');
})->name('privacy-policy');

Route::get('/contact-us', function () {
    return view('pages.contact');
})->name('contact-us');

Route::get('/carts', function () {
    return view('carts');
})->name('carts');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');
 
    Route::get('/checkout/stripe', function () {

        // dd('redirect to mpgs');
        $stripe = new \Stripe\StripeClient(
            // 'sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0'
            'sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9'
        );
        $token = $stripe->tokens->create([
        'card' => [
            'number' => '4242424242424242',
            'exp_month' => 7,
            'exp_year' => 2022,
            'cvc' => '314',
        ],
        ]);
        // dd($token->id);
        
        $gateway = \Omnipay\Omnipay::create('Stripe');
        // $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
        // $gateway->setApiKey('sk_test_UE3xmTh2owaSc94Adn91xJOx00ES1c7uqG');
        $gateway->setApiKey('sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9');

        $response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'token' => $token->id))->send();

        if ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
        } elseif ($response->isSuccessful()) {
            // payment was successful: update database
            dd($response);
        } else {
            // payment failed: display message to customer
            dd($response->getMessage());
        }

    })->name('checkout.stripe');
});


Route::get('/images/product/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->first();
    if($product->media){
        $img = \Intervention\Image\ImageManagerStatic::make(storage_path('app/public/'.$product->media->file_path));
    } else {
        $img = \Intervention\Image\ImageManagerStatic::make($product->image_file);
    }
    $img->fit(500, 500, function ($constraint) {
        $constraint->upsize();
    });     
    return $img->response();
})->name('images.product');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
