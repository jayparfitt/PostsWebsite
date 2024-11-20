<!doctype html>
<html>

<head>
    <title>Edit Post</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: Open Sans, sans-serif">

    <section class="px-6 py-8">
        <main class="max-w-3xl mx-auto bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Edit Post</h1>

            @if ($errors->any())
            <div class="bg-red-500 text-white text-sm font-bold p-4 rounded mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-bold text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="block text-sm font-bold text-gray-700">Excerpt</label>
                    <textarea id="excerpt" name="excerpt"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="body" class="block text-sm font-bold text-gray-700">Body</label>
                    <textarea id="body" name="body"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="module_id" class="block text-sm font-bold text-gray-700">Module</label>
                    <select id="module_id" name="module_id"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="" disabled>Select a module</option>
                        @foreach ($modules as $module)
                        <option value="{{ $module->id }}" {{ old('module_id', $post->module_id) == $module->id ? 'selected' : '' }}>
                            {{ $module->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                        Save Changes
                    </button>
                </div>
            </form>
        </main>
    </section>

</body>

</html>