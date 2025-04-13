<script setup></script>

<template>
    <div class="grid">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-xl font-semibold">
                        Zack Lee
                        <span class="ml-2 bg-green-200 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">Real Estate Agent</span>
                    </h2>
                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                        <span>📍 Downers Grove, IL</span>
                        <span>📧 zackle@gmail.com</span>
                        <span>✅ Licensed for 2 years</span>
                    </div>
                </div>
                <div class="flex items-center mt-4 md:mt-0">
                    <div class="text-yellow-400 text-lg space-x-1">★★★★☆</div>
                    <button class="ml-4 text-red-500 text-sm">Edit</button>
                </div>
            </div>
            <p class="text-gray-600 mt-4">Residences can be classified by and how they are connected to neighbouring residences and land. Different types of housing tenure can be used for the same physical type.</p>
        </div>

        <!-- About & Login Section -->
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col lg:flex-row justify-between">
            <!-- About Section -->
            <div class="w-full lg:w-1/2">
                <h3 class="text-lg font-bold mb-4">About</h3>
                <ul class="text-gray-700 space-y-2">
                    <li><strong>Gender:</strong> Female</li>
                    <li><strong>Birthday:</strong> 20/11/1995</li>
                    <li><strong>Phone number:</strong> <span class="text-red-500">+91 846 - 547 - 210</span></li>
                    <li><strong>Address:</strong> 549 Sulphur Springs Road, Downers, IL</li>
                </ul>

                <h3 class="text-lg font-bold mt-6 mb-4">Login Details</h3>
                <ul class="text-gray-700 space-y-2">
                    <li>
                        <strong>Email:</strong>
                        <span class="text-red-500">zackle@gmail.com</span>
                        <button class="ml-2 text-xs bg-red-100 text-red-500 px-2 py-0.5 rounded">Edit</button>
                    </li>
                    <li>
                        <strong>Password:</strong>
                        <span class="text-red-500">●●●●●●●</span>
                        <button class="ml-2 text-xs bg-red-100 text-red-500 px-2 py-0.5 rounded">Edit</button>
                    </li>
                </ul>
            </div>

            <!-- Illustration Section -->
            <div class="w-full lg:w-1/3 mt-8 lg:mt-0 flex justify-center items-center">
                <!-- Placeholder for image -->
                <div class="w-60 h-60 bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center rounded">
                    <span class="text-gray-400">[ Illustration ]</span>
                </div>
            </div>
        </div>
    </div>
</template>
