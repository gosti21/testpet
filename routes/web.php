<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variant;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('shipping', [ShippingController::class, 'index'])
    ->middleware('auth')
    ->name('shipping.index');

Route::get('checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('checkout/paid', [CheckoutController::class, 'paid'])
    ->name('checkout.paid');

Route::get('gracias', function(){
    return view('gracias');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba', function () {

    $product =  Product::find(150);

    $features = $product->options->pluck('pivot.features');

    $combinaciones = generarCombinaciones($features);

    $product->variant()->delete();

    foreach ($combinaciones as $combinacion) {

        $variant = Variant::create([
            'product_id' => $product->id,
        ]);

        $variant->features()->attach($combinacion);
    }
});

function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
{
    if ($indice == count($arrays)) {
        return [$combinacion];
    }

    $resultado = [];

    foreach ($arrays[$indice] as $item) {
        $combinacionTemporal = $combinacion;
        $combinacionTemporal[] = $item['id'];

        $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
    }

    return $resultado;
}

Route::get('prueba', function () {

    $order = Order::first();

    $pdf = Pdf::loadView('orders.ticket', compact('order'))->setPaper('a5');

    $pdf->save(Storage_path('app/public/tickets/ticket-' . $order->id . '.pdf'));

    $order->pdf_path = 'tickets/ticket-' . $order->id . '.pdf';
    $order->save();
    return view('orders.ticket', compact('order'));

});

