<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel with Tailwind & Alpine</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">
    <div x-data="{ open: false }" class="p-4 max-w-lg mx-auto bg-white shadow rounded">
        <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded">
            Toggle Content
        </button>
        <div x-show="open" class="mt-4 p-4 bg-gray-200 rounded">
            This is test
        </div>
    </div>
</body>
</html>