<form id="filter-form" method="GET" action="{{ route('home') }}" class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Filter Jobs</h2>
    <div class="flex flex-col gap-4">
        <div class="flex items-center">
            <input type="checkbox" id="full-time" name="workday[]" value="full-time" class="rounded text-blue-600 focus:ring-blue-500"
                   onchange="submitForm()" {{ in_array('full-time', request('workday', [])) ? 'checked' : '' }}>
            <label for="full-time" class="ml-3 text-gray-700 hover:text-gray-900">Full-time</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" id="part-time" name="workday[]" value="part-time" class="rounded text-blue-600 focus:ring-blue-500"
                   onchange="submitForm()" {{ in_array('part-time', request('workday', [])) ? 'checked' : '' }}>
            <label for="part-time" class="ml-3 text-gray-700 hover:text-gray-900">Part-time</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" id="remote" name="workday[]" value="remote" class="rounded text-blue-600 focus:ring-blue-500"
                   onchange="submitForm()" {{ in_array('remote', request('workday', [])) ? 'checked' : '' }}>
            <label for="remote" class="ml-3 text-gray-700 hover:text-gray-900">Remote</label>
        </div>
    </div>
</form>

<script>
    function submitForm() {
        document.getElementById('filter-form').submit();
    }
</script>


<!--<div class="p-6 bg-white">-->
<!--    <h2 class="text-2xl font-semibold text-gray-900 border-b border-gray-300">Ubicación</h2>-->
<!--    <div class="flex flex-col mt-4">-->
<!--        <div class="flex items-->
<!--                            -center gap-x-2">-->
<!--            <input type="checkbox" id="lima" name="lima" value="lima" class="rounded">-->
<!--            <label for="lima" class="ml-3">Lima</label>-->
<!--        </div>-->
<!--        <div class="flex items-->
<!--                            -center gap-x-2">-->
<!--            <input type="checkbox" id="arequipa" name="arequipa" value="arequipa" class="rounded">-->
<!--            <label for="arequipa" class="ml-3">Arequipa</label>-->
<!--        </div>-->
<!--        <div class="flex items-->
<!--                            -center gap-x-2">-->
<!--            <input type="checkbox" id="cusco" name="cusco" value="cusco" class="rounded">-->
<!--            <label for="cusco" class="ml-3">Cusco</label>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
