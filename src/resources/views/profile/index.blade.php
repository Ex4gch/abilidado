@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto pb-12">
    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">
        My Profile
    </h2>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="space-y-4">
            <div>
                <span class="text-sm font-medium text-gray-500">Full Name</span>
                <p class="text-lg text-gray-900 font-semibold">{{ $user->name }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Email Address</span>
                <p class="text-lg text-gray-900">{{ $user->email }}</p>
            </div>
        </div>

        <hr class="my-8 border-gray-100">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-medium">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">PWD Verification Status</h3>

            @if($user->is_pwd)
                <div class="inline-flex items-center px-4 py-2 rounded-lg bg-green-50 border border-green-100">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-green-800 font-medium">Verified PWD User</span>
                </div>
            @else
                <div class="inline-flex items-center px-4 py-2 rounded-lg bg-red-50 border border-red-100 mb-4">
                    <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-800 font-medium">Not Verified</span>
                </div>

                <div>
                    <button onclick="document.getElementById('pwdForm').classList.toggle('hidden')" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        Upload ID to verify your status &rarr;
                    </button>
                </div>

                <form action="/verify-pwd" method="POST" enctype="multipart/form-data" id="pwdForm" class="hidden mt-6 bg-gray-50 p-6 rounded-xl border border-gray-200">
                    @csrf
                    
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload PWD ID Card</label>
                    
                    <div id="upload-box" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors bg-white overflow-hidden">
                        
                        <div id="placeholder-container" class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex justify-center text-sm text-gray-600 mt-2">
                                <label for="pwd_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500">
                                    <span>Select a file</span>
                                    <input id="pwd_image" name="pwd_image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg" required>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 5MB</p>
                                <p class="text-xs text-blue-600 mt-2 font-medium">
                                    💡 Ensure your PWD ID Number (e.g., 07-XXXX-XXX-XXXXXXX) is clearly visible.
                                </p>
                        </div>

                        <div id="preview-container" class="hidden flex flex-col items-center gap-4 w-full">
    
                        <div class="w-full bg-gray-50 rounded-lg border border-gray-200 p-2">
                            <img id="image-preview" src="" alt="PWD ID Preview" class="w-full max-h-96 object-contain rounded shadow-sm">
                        </div>

                        <label for="pwd_image" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Change File
                        </label>
                    </div>

                    </div>

                    <button type="submit" class="mt-4 w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Scan & Verify ID
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('pwd_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const placeholder = document.getElementById('placeholder-container');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');

        if (file) {
            // Validate that the file is an image (double-check client-side)
            if (!file.type.match('image.*')) {
                alert("Please select an image file (PNG, JPG, etc.).");
                // Reset the input so they can try again
                this.value = '';
                return;
            }

            const reader = new FileReader();

            // When the file is done reading
            reader.onload = function(e) {
                // Set the image src to the file's data URL
                imagePreview.src = e.target.result;
                // Swap visibility
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }

            // Start reading the file
            reader.readAsDataURL(file);
        } else {
            // If the user canceled the file selection, go back to placeholder
            placeholder.classList.remove('hidden');
            previewContainer.classList.add('hidden');
        }
    });
</script>

@endsection