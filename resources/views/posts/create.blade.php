<!doctype html>
<x-layout>
    <h1 for="createNew" class="block text-sm font-bold text-gray-700">Create a New Post</h1>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    @if ($errors->any())
    <div class="bg-red-500 text-white text-sm font-bold p-4 rounded mt-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="mb-6">
            <label for="title" class="block text-sm font-bold text-gray-700">Title</label>
            <input type="text" id="title" name="title" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                value="{{ old('title') }}">
        </div>

        <div class="mb-6">
            <label for="excerpt" class="block text-sm font-bold text-gray-700">Excerpt</label>
            <textarea id="excerpt" name="excerpt" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">{{ old('excerpt') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="body" class="block text-sm font-bold text-gray-700">Body</label>
            <textarea id="body" name="body" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">{{ old('body') }}</textarea>
        </div>

        <div>
            <label for="module_id">Module:</label>
            <select id="module_id" name="module_id" class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                <option value="" disabled {{ old('module_id') ? '' : 'selected' }}>Select a Module</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                    {{ $module->name }}
                </option>
                @endforeach
            </select>

            <button type="button" id="addModule"
                class="mt-2 text-xs font-bold uppercase bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full">+ Add New Module</button>
        </div>

        <div id="newModuleSelection" class="mb-6 hidden">
            <label for="newModuleName" class="block text-sm font-bold text-gray-700">New Module Name</label>
            <input type="text" id="newModuleName" name="newModuleName"
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                value="{{ old('newModuleName') }}">

            <button type="button" id="cancelButton"
                class="mt-2 text-xs font-bold uppercase bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full">Cancel</button>
        </div>

        <div class="text-center">
            <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                Submit
            </button>
        </div>

        <script>
            const addModuleButton = document.getElementById('addModule');
            const cancelModuleButton = document.getElementById('cancelButton');
            const newModuleSection = document.getElementById('newModuleSelection');
            const moduleDropdown = document.getElementById('module_id');

            addModuleButton.addEventListener('click', function() {
                newModuleSection.style.display = 'block';
                moduleDropdown.disabled = true;
            });

            cancelModuleButton.addEventListener('click', function() {
                newModuleSection.style.display = 'none';
                moduleDropdown.disabled = false;
                moduleDropdown.selectedIndex = 0;
                document.getElementById('newModuleName').value = '';
            });
        </script>
    </form>
</x-layout>