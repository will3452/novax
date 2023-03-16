<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-yBBV7kRm6dlu+7HdFI6GJNE6U/Kj6+hrrfKhNg+G1eqqJJpfc5/+5J5kZf5xcnYIWcRgFF8EOrwz1v5IvlbOQ==" crossorigin="anonymous" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Create an Account</h1>
            </div>
            <form class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">
                        Name
                    </label>
                    <div class="relative">
                        <input id="name" name="name" type="text" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors" placeholder="John Doe">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-user text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <input id="email" name="email" type="email" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors" placeholder="john@example.com">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors" placeholder="********">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="address" class="block text-gray-700 font-bold mb-2">
                        Address
                    </label>
                    <div class="relative">
                        <input id="address" name="address" type="text" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors" placeholder="123 Main St">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="mobile" class="block text-gray-700 font-bold mb-2">
                        Mobile
                    </label>
                    <div class="relative">
                        <input id="mobile" name="mobile" type="tel" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors" placeholder="+1 (555) 123-4567">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-phone-alt text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="sex" class="block text-gray-700 font-bold mb-2">
                        Sex
                    </label>
                    <div class="relative">
                        <select id="sex" name="sex" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors">
                            <option value="" disabled selected>Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-venus-mars text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="birthday" class="block text-gray-700 font-bold mb-2">
                        Birthday
                    </label>
                    <div class="relative">
                        <input id="birthday" name="birthday" type="date" required class="py-2 px-3 rounded-lg w-full border-gray-300 focus:outline-none focus:ring focus:border-blue-300 transition-colors">
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-birthday-cake text-gray-400"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
