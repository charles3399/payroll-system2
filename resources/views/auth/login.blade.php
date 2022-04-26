@extends('layouts.base')

@section('title', 'Login')

@section('content')
    <section class="mx-auto my-10 bg-gray-700 w-3/4 2xl:w-1/2 xl:w-1/2 lg:w-2/4 md:w-2/4 rounded-xl p-5">
        <h4 class="text-center text-white text-3xl mb-3 font-bold tracking-wide">Login</h4>
        <div class="mb-3">
            <form action="{{ route('login') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3 text-left">
                    <label for="email" class="text-white">Email Address</label>
                    <input type="email" id="email" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@gmail.com">
                    @error('email')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-left relative">
                    <label for="password" class="text-white">Password</label>
                    <input type="password" id="password" class="form-input block p-1 w-full border-0 border-b-2 bg-gray-700 focus:ring-0 focus:border-white text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-red-400" role="alert">
                            <strong class="text-sm">{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="absolute flex items-center text-sm inset-y-0 right-0 leading-5 pr-3" onclick="togglePassword()">
                        <svg class="h-6 text-white cursor-pointer eye-show" fill="none" xmlns="http://www.w3.org/2000/svg"
                      viewbox="0 0 576 512">
                            <path fill="currentColor"
                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                        </svg>

                        <svg class="h-6 text-white cursor-pointer hidden eye-hide" fill="none" xmlns="http://www.w3.org/2000/svg"
                        viewbox="0 0 640 512">
                            <path fill="currentColor"
                                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="remember" class="
                    form-checkbox
                    rounded
                    border-gray-300
                    text-blue-500
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-offset-0
                    focus:ring-indigo-200
                    focus:ring-opacity-50"
                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-white text-sm mx-1">Remember Me</label>
                </div>
                <div class="mb-0">
                    <button type="submit" class="px-4 py-1.5 bg-blue-500 hover:bg-blue-700 transition duration-200 text-white text-sm rounded-lg">Login</button>
                    @if (Route::has('password.request'))
                        <a class="text-white text-sm hover:underline mx-3" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const toggle = document.getElementById('password')
            const show = document.querySelector('.eye-show')
            const hidden = document.querySelector('.eye-hide')
            if(toggle.type === 'password') {
                toggle.type = 'text'
                show.classList.add('hidden')
                show.classList.remove('block')
                hidden.classList.remove('hidden')
                hidden.classList.add('block')
            }
            else {
                toggle.type = 'password'
                show.classList.add('block')
                show.classList.remove('hidden')
                hidden.classList.remove('block')
                hidden.classList.add('hidden')
            }
        }
    </script>
@endpush