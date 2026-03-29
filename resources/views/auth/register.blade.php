<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ÉLIXIRÉ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-white text-gray-900">
    <div class="flex min-h-screen w-full">
        
        <div class="hidden lg:flex lg:w-1/2 relative items-end pb-24 pl-16 bg-black">
            <img src="{{ asset('img/bg-login.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
            
            <div class="absolute top-10 left-10 z-20">
                <h3 class="text-white font-bold tracking-[0.3em] text-xl">ÉLIXIRÉ</h3>
            </div>

            <div class="relative z-10 text-white border-l-4 border-[#D4A34D] pl-6">
                <h2 class="text-3xl font-light italic leading-tight">Scent of authority</h2>
                <h1 class="text-6xl font-extrabold tracking-tight uppercase">Unspoken Influence</h1>
                <div class="w-20 h-1 bg-[#D4A34D] mt-4"></div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-8 md:px-16 lg:px-24 py-12">
            <div class="w-full max-w-lg">
                
                @if (session('success_message'))
                    <div id="alert-success" class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 shadow-sm flex items-center justify-between transform transition-all duration-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-medium italic">{{ session('success_message') }}</span>
                        </div>
                        <button onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-800 text-xl font-bold">×</button>
                    </div>
                    <script>
                        setTimeout(() => {
                            let alert = document.getElementById('alert-success');
                            if(alert) alert.style.opacity = '0';
                            setTimeout(() => { if(alert) alert.remove(); }, 500);
                        }, 4000);
                    </script>
                @endif

                <div class="mb-10">
                    <h2 class="text-5xl font-serif text-gray-900 mb-3 leading-tight">Buat Akun Anda</h2>
                    <p class="text-gray-400 italic text-lg font-light">Mulailah perjalanan wangimu hari ini.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-1 group">
                        <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-widest transition-colors group-focus-within:text-[#D4A34D]">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-0 py-2 border-b-2 border-gray-200 focus:border-[#D4A34D] bg-transparent outline-none transition-all duration-300 text-lg">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div class="space-y-1 group">
                        <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-widest transition-colors group-focus-within:text-[#D4A34D]">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-0 py-2 border-b-2 border-gray-200 focus:border-[#D4A34D] bg-transparent outline-none transition-all duration-300 text-lg">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-1 group">
                        <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-widest transition-colors group-focus-within:text-[#D4A34D]">Kata Sandi</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-0 py-2 border-b-2 border-gray-200 focus:border-[#D4A34D] bg-transparent outline-none transition-all duration-300 text-lg">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="space-y-1 group">
                        <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-widest transition-colors group-focus-within:text-[#D4A34D]">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-0 py-2 border-b-2 border-gray-200 focus:border-[#D4A34D] bg-transparent outline-none transition-all duration-300 text-lg">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <div class="flex items-center pt-2">
                        <input id="terms" type="checkbox" required class="rounded border-gray-300 text-[#D4A34D] shadow-sm focus:ring-[#D4A34D]">
                        <label for="terms" class="ml-2 text-sm text-gray-500 italic">
                            Setuju dengan Syarat & Ketentuan
                        </label>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#D4A34D] hover:bg-black text-white font-bold py-4 rounded-sm shadow-xl transition-all duration-500 uppercase tracking-widest text-sm flex items-center justify-center group">
                            Register 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-center text-sm text-gray-400 pt-4">
                        Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:text-[#D4A34D] ml-1 border-b border-gray-900">Login</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</body>
</html>