<x-homepage.layout>
    <div class="max-w-5xl mx-auto px-4 py-6">

        <h1 class="text-2xl font-semibold text-gray-800 mb-10">
            Profil Saya
        </h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow p-6 md:col-span-1">
                <div class="flex flex-col items-center text-center">

                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                            class="h-28 w-28 rounded-full object-cover border mb-4">
                    @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-4">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>

                    <!-- GANTI PASSWORD -->
                    <button data-modal-target="change-password-modal" data-modal-toggle="change-password-modal"
                        class="mt-3 px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                        Ganti Password
                    </button>

                    <div class="w-full border-t border-gray-300/40 my-4"></div>

                    <div class="w-full text-left text-sm space-y-2">
                        <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
                    </div>
                </div>
            </div>

            <!-- FORM EDIT PROFILE -->
            <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
                <form method="POST" action="{{ route('general.update') }}" enctype="multipart/form-data"
                    class="space-y-4">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 w-full rounded-md border-gray-300 border
                                   focus:ring-indigo-500 focus:ring-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}"
                                class="mt-1 w-full rounded-md border-gray-300 border
                                   focus:ring-indigo-500 focus:ring-2" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 w-full rounded-md border-gray-300 border
                                   focus:ring-indigo-500 focus:ring-2" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Foto Profil
                            </label>
                            <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:bg-indigo-50 file:text-indigo-700
                                   hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-300/40">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-homepage.layout>