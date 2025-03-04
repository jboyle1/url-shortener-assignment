<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel URL Shortener</title>

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg" x-data="urlShortener()">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-4">URL Shortener</h1>

        <!-- Input Field for URL -->
        <div class="mb-4">
            <label for="url" class="block text-gray-600 mb-2">Enter URL to Shorten:</label>
            <input id="url" type="text" x-model="originalUrl" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter a URL">
        </div>

        <!-- Shorten Button -->
        <button @click="shortenUrl"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Shorten URL
        </button>

        <!-- Display Shortened URL -->
        <div x-show="shortUrl" class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg">
            <strong>Shortened URL:</strong>
            <a :href="shortUrl" target="_blank" class="text-blue-500 underline">
                <span x-text="shortUrl"></span>
            </a>
        </div>

        <!-- Display Errors -->
        <div x-show="error" class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
            <span x-text="error"></span>
        </div>

        <!-- Input for Decoding Shortened URL -->
        <div class="mt-6">
            <label for="shortCode" class="block text-gray-600 mb-2">Enter Short Code to Retrieve Original URL:</label>
            <input id="shortCode" type="text" x-model="shortCode"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter short code">
        </div>

        <!-- Decode Button -->
        <button @click="decodeUrl"
            class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition mt-2">
            Retrieve Original URL
        </button>

        <!-- Display Original URL -->
        <div x-show="originalDecodedUrl" class="mt-4 p-3 bg-yellow-100 text-yellow-700 rounded-lg">
            <strong>Original URL:</strong>
            <a :href="originalDecodedUrl" target="_blank" class="text-blue-500 underline">
                <span x-text="originalDecodedUrl"></span>
            </a>
        </div>
    </div>

    <script>
    function urlShortener() {
        return {
            originalUrl: '',
            shortUrl: '',
            shortCode: '',
            originalDecodedUrl: '',
            error: '',

            // Function to shorten URL
            async shortenUrl() {
                this.error = ''; // Reset error on each click
                try {
                    // Get the CSRF token from the meta tag
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Send the POST request with CSRF token in the headers
                    let response = await fetch('/encode', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken  // Add CSRF token here
                        },
                        body: JSON.stringify({ url: this.originalUrl })
                    });

                    let data = await response.json();

                    if (response.ok) {
                        this.shortUrl = data.short_url; // Display the shortened URL
                    } else {
                        this.error = data.error || 'Failed to shorten URL';
                    }
                } catch (err) {
                    this.error = 'An error occurred';
                }
            },

            // Function to decode short URL
            async decodeUrl() {
                this.error = ''; // Reset error on each click
                try {
                    let response = await fetch(`/decode/${this.shortCode}`);
                    let data = await response.json();

                    if (response.ok) {
                        this.originalDecodedUrl = data.original_url; // Display original URL
                    } else {
                        this.error = data.error || 'Short URL not found';
                    }
                } catch (err) {
                    this.error = 'An error occurred';
                }
            }
        };
    }
</script>

</body>
</html>
