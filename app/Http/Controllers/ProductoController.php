<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $query = Producto::query();
        $productos = $query -> paginate(15);

        return view('productos.index',compact('productos'));
    }

}
