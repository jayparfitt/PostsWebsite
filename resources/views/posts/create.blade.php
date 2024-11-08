<!doctype html>
<x-layout>
    <h1>Create a New Post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
        </div>

        <div>
            <label for="excerpt">Excerpt:</label>
            <textarea id="excerpt" name="excerpt" required></textarea>
        </div>

        <div>
            <label for="body">Body</label>
            <textarea id="body" name="body" required></textarea>
        </div>

        <div>
            <label for="module_id">Module:</label>
            <select id="module_id" name="module_id">
                <option value="" disabled select>Select a Module</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>

            <button type="button" id="addModule">+ Add New Module</button>
        </div>
        <!-- hidden section, appears when creating a new ,module -->
        <div id="newModuleSelection" style="display: none; margin-top: 10px;">
            <label for="newModuleName">New Module Name</label>
            <input type="text" id="newModuleName" name="newModuleName">
        </div>
        <button type="submit">Submit</button>

        <script>
            document.getElementById('addModule').addEventListener('click', function() {
                const newModuleSection = document.getElementById('newModuleSelection');
                newModuleSection.style.display = newModuleSection.style.display === 'none' ? 'block' : 'none';
            });
        </script>
</x-layout>