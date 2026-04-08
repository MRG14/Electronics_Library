<!DOCTYPE html>
<html>

<head>
    <!-- Meta Tag - Encoding Character Information -->
    <meta charset="utf-8">

    <!-- Meta Tag - Support Responsive Layout -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title: Start -->
    <title>Kategori | {{ config('app.name', 'Digital Library') }}</title>
    <!-- Laravel Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="w-full flex flex-col">
    <!-- Header Component -->
    <x-header class="text-black px-5 lg:px-10 mt-5 lg:mt-10"></x-header>

    <!-- Category Section: Start -->
    <section id="category-section" class="w-full flex flex-col pt-5 lg:pt-10 pb-15 px-5 lg:px-10">

        <h2 class="font-bold text-2xl lg:text-4xl">
            Kategori Buku
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10 mt-5">
            @foreach ($categories as $category)
                <x-category-item :category="$category"></x-category-item>
            @endforeach
        </div>
    </section>
    <!-- Category Section: End -->

    <!-- Footer Component -->
    <x-footer></x-footer>
</body>

</html>