<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YukNonton.com</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
<div class="flex items-center justify-center mb-6">
    <i class="fas fa-ticket-alt text-blue-700 text-3xl mr-2"></i>
    <h1 class="text-2xl font-bold text-blue-700">YukNonton.com</h1>
</div>

<div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-8 border-2 border-black">
    <h2 class="text-xl font-semibold text-center">Hai selamat datang kembali!</h2>
    <p class="text-center text-gray-600 mb-8">Belum punya akun? <a href="register.html" class="text-blue-500 font-semibold">Daftar di sini</a></p>

    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 flex items-center justify-center p-8">
            <img src="https://assets.loket.com/web/assets/img/auth.svg" alt="Illustration" class="w-64 h-64">
        </div>

        <div class="md:w-1/2 p-8">
            <form>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" id="username" placeholder="Masukkan alamat email / username Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" id="password" placeholder="Masukkan password Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
