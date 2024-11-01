<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - YukNonton.com</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
<div class="flex items-center justify-center mb-6">
    <i class="fas fa-ticket-alt text-blue-700 text-3xl mr-2"></i>
    <h1 class="text-2xl font-bold text-blue-700">YukNonton.com</h1>
</div>

<div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-8 border-2 border-black">
    <h2 class="text-xl font-semibold text-center">Buat akun YukNonton mu!</h2>
    <p class="text-center text-gray-600 mb-8">Sudah punya akun? <a href="index.html" class="text-blue-500 font-semibold">Login</a></p>

    <form method="POST">
        <!-- @csrf -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name<span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" placeholder="Masukkan Nama Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email<span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" placeholder="Masukkan Email Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password<span class="text-red-500">*</span></label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmation Password<span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan Password Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">Register</button>
        </div>
    </form>
</div>
</body>
</html>
