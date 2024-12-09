<!doctype html>

<title>Main Page</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

@livewireStyles
@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Displays a success message when a CRUD action is completed -->
@if (session('success'))
<div id="success-popup" class="relative bg-green-500 text-white text-sm font-bold p-4 rounded mt-4">
    <button
        id="close-success-popup"
        class="absolute top-1 right-2 text-white font-bold"
        aria-label="Close">
        &times;
    </button>
    {{ session('success') }}
</div>

<script>
    document.getElementById('close-success-popup').addEventListener('click', function() {
        document.getElementById('success-popup').style.display = 'none';
    });
</script>
@endif

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.png" alt="testTitle" width="180" height="50">
                </a>
            </div>

            <nav class="md:flex md:justify-between md:items-center">

                <!-- Text Resize Controls -->
                <div id="text-resize-controls" class="flex space-x-2">
                    <button id="text-enlarge" class="bg-blue-500 text-white py-1 px-3 rounded-full" aria-label="Increase text size">A+</button>
                    <button id="text-reset" class="bg-gray-500 text-white py-1 px-3 rounded-full" aria-label="Reset text size">A</button>
                    <button id="text-minimize" class="bg-blue-500 text-white py-1 px-3 rounded-full" aria-label="Decrease text size">A-</button>
                </div>

            </nav>


            <div class="mt-8 md:mt-0 flex items-center space-x-4">
                <a href="/" class="text-xs font-bold uppercase">Home Page</a>

                <!-- Button only shown when not on the search books tab -->
                <a href="{{ route('openLibrary.search') }}"
                    class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold py-2 px-4 rounded-full"
                    @if(Route::currentRouteName()==='openLibrary.search' ) style="display: none;" @endif>
                    Search Books
                </a>

                <!-- Button only shown when user isn't logged in -->
                @guest
                <a href="{{ route('register') }}" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Create Account
                </a>

                <!-- Button only shown when user isn't logged in -->
                <a href="{{ route('login') }}" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Login
                </a>
                @endguest

                <!-- User dropdown options, only show when User/Admin is logged in -->
                @auth
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center focus:outline-none">
                        <img class="h-8 w-8 rounded-full border-2 border-gray-300"
                            src="/images/userIcon.png"
                            alt="{{ Auth::user()->name }}">
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                        <a href="{{ route('users.posts', Auth::id()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            My Posts
                        </a>
                        <a href="{{ route('users.edit', Auth::id()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!--Create post option is displayed for Admins only -->
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('posts.create') }}" class="btn btn-primary bg-blue-500 text-white rounded-full px-3 py-2 hover:bg-blue-600">
                    Create New Post
                </a>
                <!-- Notification option is displayed for Admins only -->
                <div class="relative">
                    <button id="notifications-button" class="text-sm font-medium">
                        🔔 Notifications
                    </button>
                    <div id="notifications-dropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-md hidden">
                        <!-- If no notifications, the following is displayed -->
                        @if(auth()->user()->notifications->isEmpty())
                        <p class="p-4 text-gray-500 text-sm">No new notifications</p>
                        @else
                        <!-- Shows all notifications for that admin -->
                        @foreach(auth()->user()->unreadNotifications as $notification)
                        <div class="p-2 border-b flex justify-between items-center">
                            <div>
                                <a href="{{ route('posts.show', $notification->data['post_id']) }}" class="text-blue-500 hover:underline">
                                    {{ $notification->data['message'] }}
                                </a>
                            </div>
                            <!-- Mark as read allows the notifications to be removed -->
                            <button
                                class="text-red-500 hover:underline text-xs"
                                onclick="markAsRead('{{ $notification->id }}', this)">
                                Mark as read
                            </button>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
                @endauth
            </div>
        </nav>

        {{ $slot }}

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Subscribe to be notified of new posts</h5>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">
                    <form method="POST" action="#" class="lg:flex text-sm">
                        <div class="lg:py-3 lg:px-5 flex items-center">


                            <input id="email" type="text" placeholder="Your email address"
                                class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>

    <script>
        // Toggle User Menu Dropdown
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenuDropdown = document.getElementById('user-menu-dropdown');

        userMenuButton.addEventListener('click', () => {
            userMenuDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Notification dropdown when button is pressed -->
    <script>
        document.getElementById('notifications-button').addEventListener('click', () => {
            const dropdown = document.getElementById('notifications-dropdown');
            dropdown.classList.toggle('hidden');
        });

        function markAsRead(notificationId, buttonElement) {
            // Send a POST request to mark the notification as read
            fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the notification from the DOM
                        const notificationDiv = buttonElement.closest('div');
                        notificationDiv.remove();

                        // Show a "No new notifications" message
                        const dropdown = document.getElementById('notifications-dropdown');
                        if (dropdown.querySelectorAll('.p-2').length === 0) {
                            dropdown.innerHTML = '<p class="p-4 text-gray-500 text-sm">No new notifications</p>';
                        }
                    } else {
                        console.error('Failed to mark notification as read');
                    }
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                });
        }
    </script>

    @livewireScripts

</body>