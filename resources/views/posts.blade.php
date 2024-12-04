<x-layout>

    <header class="max-w-xl mx-auto mt-20 text-center space-y-4">
        <h1 class="text-4xl">Main Page</h1>
        <h2 class="inline-flex mt-2">By Jay Parfitt</h2>
        <p class="text-sm mt-14">Here are all posts! Use the filters below to search</p>

        <!-- Module Filter -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl mt-4">
            <select id="module-filter" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold border-none focus:outline-none focus:ring-0">
                <option value="" selected>All Modules</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sorting Options -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl mt-4">
            <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold border-none focus:outline-none focus:ring-0">
                <option value="category" disabled selected>Sort By</option>
                <option value="up">Date Added (Ascending)</option>
                <option value="down">Date Added (Descending)</option>
                <option value="popularity">Popularity</option>
            </select>

            <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22" height="22" viewBox="0 0 22 22">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z"></path>
                    <path fill="#222" d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                </g>
            </svg>
        </div>

        <!-- Search Input -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2 mt-4">
            <livewire:search-posts />
        </div>
    </header>


    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
        <!-- Post Container -->
        <div id="posts-container">
            @foreach ($posts as $post)
            <div data-module-id="{{ $post->module_id }}">
                <x-latestPost :post="$post" />
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center">No posts yet. Please come back later.</p>
        @endif
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('module-filter').addEventListener('change', function() {
                const moduleId = this.value;
                const allPosts = document.querySelectorAll('#posts-container > div');
                allPosts.forEach(post => {
                    if (!moduleId || post.dataset.moduleId == moduleId) {
                        post.style.display = '';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        });
    </script>

</x-layout>