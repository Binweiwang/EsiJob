<form action="/checkout" method="post">
    <input  type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Comprar</button>
</form>
