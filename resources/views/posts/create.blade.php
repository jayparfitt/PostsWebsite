<!doctype html>
<x-layout>
    <h1 for="createNew" class="block text-sm font-bold text-gray-700">Create a New Post</h1>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="mb-6">
            <label for="title" class="block text-sm font-bold text-gray-700">Title</label>
            <input type="text" id="title" name="title" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-6">
            <label for="excerpt" class="block text-sm font-bold text-gray-700">Excerpt</label>
            <textarea id="excerpt" name="excerpt" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"></textarea>
        </div>

        <div class="mb-6">
            <label for="body" class="block text-sm font-bold text-gray-700">Body</label>
            <textarea id="body" name="body" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"></textarea>
        </div>

        <div>
            <label for="module_id">Module:</label>
            <select id="module_id" name="module_id">
                <option value="" disabled select>Select a Module</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>

            <button type="button" id="addModule"
                class="mt-2 text-xs font-bold uppercase bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full">+ Add New Module</button>
        </div>
        <!-- hidden section, appears when creating a new ,module -->
        <div id="newModuleSelection" class="mb-6 hidden">
            <label for="newModuleName" class="block text-sm font-bold text-gray-700">New Module Name</label>
            <input type="text" id="newModuleName" name="newModuleName"
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="text-center">
            <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                Submit
            </button>
        </div>

        <script>
            document.getElementById('addModule').addEventListener('click', function() {
                const newModuleSection = document.getElementById('newModuleSelection');
                newModuleSection.style.display = newModuleSection.style.display === 'none' ? 'block' : 'none';
            });
        </script>
</x-layout>