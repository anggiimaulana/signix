    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signix Login</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <div class="min-h-screen flex justify-center items-center p-4">
            <div class="bg-white shadow-lg rounded-lg flex overflow-hidden max-w-4xl w-full">
                <!-- Left Side -->
                <div class="w-1/2 bg-blue-50 ">
                    <img src="{{ asset('images/gambar_login.png') }}" alt="Building" class="w-full h-full rounded-lg shadow-md">
                </div>

                <!-- Right Side -->
                <div class="w-1/2 p-10">
                    <div class="w-40 mb-[-50px]">
                        <img src="{{ asset('images/logo_signix.png') }}" alt="">
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" onsubmit="return validateForm()">
                        @csrf

                        <div class="mb-4 mt-4">
                            <label for="role" class="block mb-2 text-gray-600">Masuk Sebagai</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <span class="text-gray-500 pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <select id="role" name="role" class="w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-md" onchange="toggleInputField()">
                                    <option value="">-</option>
                                    <option value="ormawa">Ormawa</option>
                                    <option value="dosen">Dosen</option>
                                </select>
                            </div>
                        </div>

                        <!-- Alert message for failed login -->
                        @if ($errors->has('login'))
                            <p class="text-red-600 mb-4">{{ $errors->first('login') }}</p>
                        @endif

                        <!-- Input for email (Admin) -->
                        <div id="emailField" class="mb-4" style="display: none;">
                            <label for="email" class="block mb-2 text-gray-600">Email</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <input type="email" name="email" id="email" class="w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-md">
                            </div>
                        </div>

                        <!-- Input for NIM (Ormawa) -->
                        <div id="nimField" class="mb-4" style="{{ old('role') === 'ormawa' ? 'display: block;' : 'display: none;' }}">
                            <label for="nim" class="block mb-2 text-gray-600">NIM</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" class="w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-md">
                            </div>
                        </div>

                        <!-- Input for NIP (Dosen) -->
                        <div id="nipField" class="mb-4" style="{{ old('role') === 'dosen' ? 'display: block;' : 'display: none;' }}">
                            <label for="nip" class="block mb-2 text-gray-600">NIP</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <input type="text" name="nip" id="nip" value="{{ old('nip') }}" class="w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-md">
                            </div>
                        </div>

                        <div class="mb-6" id="passwordField" style="{{ old('role') ? 'display: block;' : 'display: none;' }}">
                            <label for="password" class="block mb-2 text-gray-600">Password</label>
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <span class="text-gray-500 pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input id="password" name="password" type="password" placeholder="Masukkan Kata sandi" class="w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-md">
                                <button type="button" onclick="togglePasswordVisibility()" class="text-gray-500 pr-3 focus:outline-none">
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Alert message -->
                        <div id="roleAlert" class="text-red-600 mb-4" style="display: none;">
                            Please select a role before submitting the form.
                        </div>

                        <button type="submit" id="submitButton" class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition" style="display: none;">Masuk</button>
                    </form>

                    <p class="text-xs text-gray-500 mt-4 text-center">
                        Dengan menggunakan layanan kami, Anda berarti setuju atas <a href="#" class="text-blue-600">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-600">Kebijakan Privasi</a> Signix
                    </p>
                </div>
            </div>
        </div>

        <script>
            function toggleInputField() {
                var role = document.getElementById('role').value;
                document.getElementById('emailField').style.display = 'none';
                document.getElementById('nimField').style.display = (role === 'ormawa') ? 'block' : 'none';
                document.getElementById('nipField').style.display = (role === 'dosen') ? 'block' : 'none';
                document.getElementById('passwordField').style.display = role ? 'block' : 'none';

                // Hide or show the submit button and "Lupa kata sandi?" link based on role selection
                document.getElementById('submitButton').style.display = role ? 'block' : 'none';
                document.getElementById('forgotPasswordLink').style.display = role ? 'block' : 'none';
            }

            function validateForm() {
                var role = document.getElementById('role').value;
                var roleAlert = document.getElementById('roleAlert');

                if (!role) {
                    roleAlert.style.display = 'block';
                    return false; // Prevent form submission
                }
                roleAlert.style.display = 'none';

                return true; // Allow form submission
            }

            function togglePasswordVisibility() {
                var passwordInput = document.getElementById('password');
                var eyeIcon = document.getElementById('eyeIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.innerHTML = '<path d="M17.94 17.94A10.97 10.97 0 0112 20c-5.52 0-10-4.48-10-10S6.48 0 12 0c2.61 0 5.01 1.01 6.94 2.94M1 1l22 22"></path>';
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                }
            }
        </script>
    </body>
    </html>
