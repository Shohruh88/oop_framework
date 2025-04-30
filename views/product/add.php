@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Biz quramiz, siz yashaysiz</h1>
        <p class="mt-6 text-lg text-gray-600">Zamonaviy va ishonchli qurilish yechimlari</p>
        <a href="/contact" class="mt-8 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">Bog'lanish</a>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Xizmatlarimiz</h2>
            <p class="text-gray-600 mt-2">Biz taklif qiladigan asosiy xizmatlar</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Qurilish ishlari</h3>
                <p class="text-gray-600 mt-2">Yirik obyektlar va turar joylar uchun qurilish xizmatlari</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Ta'mirlash va dizayn</h3>
                <p class="text-gray-600 mt-2">Ichki va tashqi ta'mirlash, dizayn xizmatlari</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Muhandislik tizimlari</h3>
                <p class="text-gray-600 mt-2">Isitish, sovutish, suv ta'minoti tizimlari o'rnatish</p>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Yakunlangan loyihalar</h2>
            <p class="text-gray-600">Biz amalga oshirgan loyihalardan namunalar</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="overflow-hidden rounded-lg shadow-md">
                <img src="/images/project1.jpg" alt="Loyiha 1" class="w-full h-60 object-cover">
            </div>
            <div class="overflow-hidden rounded-lg shadow-md">
                <img src="/images/project2.jpg" alt="Loyiha 2" class="w-full h-60 object-cover">
            </div>
            <div class="overflow-hidden rounded-lg shadow-md">
                <img src="/images/project3.jpg" alt="Loyiha 3" class="w-full h-60 object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="bg-blue-600 py-20">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-white">Loyihangiz haqida maslahat olishni xohlaysizmi?</h2>
        <p class="text-blue-100 mt-4">Biz bilan bog'laning va bepul maslahat oling</p>
        <a href="/contact" class="mt-6 inline-block bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg">Biz bilan bog'laning</a>
    </div>
</section>

@endsection
