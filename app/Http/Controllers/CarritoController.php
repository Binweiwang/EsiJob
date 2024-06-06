<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    public function index()
    {
        $cartItems = Carrito::where('user_id', Auth::id())->get();
        return view('carrito.carrito', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        Log::info('Request Data:', $request->all());

        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.quantity' => 'required|integer|min:1',
        ]);

        $productos = $request->input('productos', []);

        foreach ($productos as $producto) {
            Carrito::updateOrCreate(
                ['user_id' => Auth::id(), 'producto_id' => $producto['id']],
                ['quantity' => $producto['quantity']]
            );
        }

        return redirect()->route('carrito.index')->with('success', 'Productos añadidos al carrito! 🛒');
    }
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
        ]);

        $productId = $request->input('product_id');

        Carrito::where('user_id', Auth::id())
            ->where('producto_id', $productId)
            ->delete();

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito! 🛒');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'quantity' => 'required|integer',
        ]);

        $item = Carrito::where('user_id', Auth::id())
            ->where('producto_id', $request->product_id)
            ->first();

        if ($item) {
            $item->quantity = $request->quantity;
            $item->save();
        }

        return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada correctamente.');
    }
}
