<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function cancel()
    {
        return view('stripe.cancel');
    }

    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Obtener los artículos del carrito de compras del usuario actual
        $cartItems = Carrito::where('user_id', Auth::id())->with('producto')->get();

        //Convierte los artículos del carrito de compras a line_items de Stripe
        $lineItems = $cartItems->map(function ($item) {
            $producto = $item->producto;
            if (!$producto || !$producto->nombre || !$producto->precio) {
                Log::error('Producto data is missing', ['producto' => $producto]);
                return null;
            }

            return [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $producto->nombre,
                    ],
                    'unit_amount' => $producto->precio * 100,
                ],
                'quantity' => $item->quantity,
            ];
        })->filter()->toArray();

        if (empty($lineItems)) {
            return back()->with('error', 'No se pueden procesar artículos en el carrito de compras. Por favor verifique la información del producto e inténtelo nuevamente.');
        }

        try {
            // Crear Stripe Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);

            return redirect($session->url, 303);
        } catch (Exception $e) {
            Log::error('Error creating Stripe session: ' . $e->getMessage());
            return back()->with('error', 'Error al crear sesión de pago: ' . $e->getMessage());
        }
    }


    public function success()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener los artículos del carrito de compras del usuario
        $cartItems = Carrito::where('user_id', $user->id)->with('producto')->get();

        // Calcular el total de créditos
        $totalCredits = $cartItems->sum(function ($item) {
            return $item->producto->creditos * $item->quantity;
        });

        // Agregar créditos al usuario
        $user->credits += $totalCredits;
        $user->save();

        // Vaciar el carrito de compras
        Carrito::where('user_id', $user->id)->delete();

        return view('stripe.success', compact('totalCredits'));
    }
}
