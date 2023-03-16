<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css">
</head>
<body class="bg-gray-200">

    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6">Book an Appointment</h1>

        <form action="#" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Full Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border rounded-lg">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div>
                    <label for="date" class="block text-gray-700 font-bold mb-2">Appointment Date</label>
                    <input type="date" name="date" id="date" class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label for="time" class="block text-gray-700 font-bold mb-2">Appointment Time</label>
                    <input type="time" name="time" id="time" class="w-full p-2 border rounded-lg">
                </div>
            </div>

            <div class="mt-4">
                <label for="message" class="block text-gray-700 font-bold mb-2">Additional Information</label>
                <textarea name="message" id="message" rows="5" class="w-full p-2 border rounded-lg"></textarea>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Book Now</button>
            </div>
        </form>
    </div>

</body>
</html>
