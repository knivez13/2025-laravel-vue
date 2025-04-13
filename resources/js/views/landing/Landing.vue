<script setup></script>

<template>
    <div>
        <header class="w-full py-4 px-8 shadow-lg">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-red-500">COMP U.P.</h1>
                <nav>
                    <ul class="flex space-x-6 text-gray-900">
                        <li><a href="#" class="hover:text-red-500">Home</a></li>
                        <li><a href="#" class="hover:text-red-500">Listings</a></li>
                        <li><a href="#" class="hover:text-red-500">Pricing</a></li>
                        <li><a href="#" class="hover:text-red-500">Agent List</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Hero with Map and Search Filter -->
        <section class="relative h-[400px] bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1920x400')">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
                    <h2 class="text-xl font-semibold mb-4">Where I'm Gonna Start?</h2>
                    <div class="space-y-3">
                        <input type="text" placeholder="Search" class="w-full border border-gray-300 rounded p-2" />
                        <select class="w-full border border-gray-300 rounded p-2">
                            <option>Category Type</option>
                        </select>
                        <select class="w-full border border-gray-300 rounded p-2">
                            <option>For Rent</option>
                        </select>
                        <select class="w-full border border-gray-300 rounded p-2">
                            <option>Agriculture</option>
                        </select>
                        <button class="bg-red-500 text-white px-4 py-2 rounded">Search</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hottest Deals Section -->
        <section class="py-12 px-4 max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-8 text-red-500">This List Of The Hottest Deal</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Card Example -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <img src="https://via.placeholder.com/400x250" class="rounded-t-xl w-full h-48 object-cover" alt="property" />
                    <div class="p-4">
                        <h3 class="font-semibold text-lg">Modern Luxury Living</h3>
                        <p class="text-sm text-gray-600">Spacious Condo with Stunning Views</p>
                        <p class="mt-2 text-red-500 font-bold">₱2,000,000</p>
                    </div>
                </div>
                <!-- Repeat card 2 more times -->
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-12 bg-white px-4">
            <h2 class="text-2xl font-bold text-center mb-8 text-red-500">Property Services</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <div class="text-center p-6 border rounded-xl">
                    <div class="text-red-500 text-3xl mb-2">🏢</div>
                    <h3 class="font-bold mb-2">Property Management</h3>
                    <p class="text-sm text-gray-600">Professional management for your real estate.</p>
                </div>
                <div class="text-center p-6 border rounded-xl">
                    <div class="text-red-500 text-3xl mb-2">💬</div>
                    <h3 class="font-bold mb-2">LiveChat</h3>
                    <p class="text-sm text-gray-600">Talk directly to an agent any time.</p>
                </div>
                <div class="text-center p-6 border rounded-xl">
                    <div class="text-red-500 text-3xl mb-2">📊</div>
                    <h3 class="font-bold mb-2">Dashboard Service</h3>
                    <p class="text-sm text-gray-600">Full control through your property dashboard.</p>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-12 bg-gray-100 px-4">
            <h2 class="text-2xl font-bold text-center mb-8 text-red-500">What People Say</h2>
            <div class="max-w-4xl mx-auto grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="italic">“Great experience! They really helped me find the perfect property.”</p>
                    <p class="mt-4 font-semibold">– Allie Grater</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="italic">“Everything was easy, from searching to signing.”</p>
                    <p class="mt-4 font-semibold">– Barry Kade</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="italic">“Fast service and professional agents.”</p>
                    <p class="mt-4 font-semibold">– Neil Down</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-10 px-4">
            <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-2">COMP U.P.</h3>
                    <p class="text-sm text-gray-400">Discover the hottest deals, property services, and more.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Useful Links</h4>
                    <ul class="text-sm space-y-1 text-gray-400">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Listing</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Agent List</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Social</h4>
                    <ul class="text-sm space-y-1 text-gray-400">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Subscribe</h4>
                    <input type="email" placeholder="Enter your email" class="w-full p-2 rounded text-black" />
                    <button class="bg-red-500 text-white w-full mt-2 py-2 rounded">Subscribe</button>
                </div>
            </div>
            <p class="text-center text-xs text-gray-500 mt-8">© 2025 COMP U.P. All rights reserved.</p>
        </footer>
    </div>
</template>
