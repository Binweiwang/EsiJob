<div>
    <form action="{{ route('home') }}" method="GET">
        <div class="flex items-center">
            <input type="text" name="search" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 text-gray-800" placeholder="Search for jobs">
            <button type="submit" class="ml-3 bg-red-600 text-white rounded-md px-4 py-2">Search</button>
        </div>
    </form>
</div>
