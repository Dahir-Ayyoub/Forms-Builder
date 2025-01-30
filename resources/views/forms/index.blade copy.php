@extends('layouts.app')
@section('content')
<style>
    #qrModal {
    backdrop-filter: blur(3px);
}

#qrModal img {
    max-width: 100%;
    height: auto;
}
</style>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold color-black">Your Forms</h1>
           @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('forms.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                Create New Form
            </a>
            @endif
        </div>

        @if($forms->isEmpty())
            <div class="bg-gray-50 p-6 rounded-lg text-center">
                <p class="text-gray-500">
                    @if(auth()->user()->hasRole('admin'))
                        You haven't created any forms yet.
                    @else
                        No forms have been assigned to you yet.
                    @endif
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($forms as $form)
                    <div class="relative flex flex-col my-6 bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-slate-200 w-96">
                        <!-- Status Indicator - You can modify the color based on form status -->
                        <div class="absolute top-0 right-0 m-4 flex items-center">
                            <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                            <span class="text-sm text-slate-500">Active</span>
                        </div>

                        <div class="relative p-6">
                            <!-- Header Section -->
                            <div class="mb-6">
                                <div class="flex items-start justify-between">
                                    <h6 class="text-xl font-semibold text-slate-800 truncate max-w-[80%]">
                                        {{ $form->title }}
                                    </h6>
                                </div>
                                <div class="mt-2 flex items-center text-slate-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">{{ $form->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($form->client)
                                    <div class="mt-2 flex items-center text-slate-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-sm">
                                            {{ $form->client->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Stats Section with Icons -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-slate-50 rounded-lg p-4 text-center">
                                    <div class="flex items-center justify-center text-slate-600 mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <p class="text-2xl font-bold text-slate-700">{{ $form->views_count }}</p>
                                    <p class="text-sm text-slate-500">Views</p>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-4 text-center">
                                    <div class="flex items-center justify-center text-slate-600 mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-2xl font-bold text-slate-700">{{ $form->submissions_count }}</p>
                                    <p class="text-sm text-slate-500">Submissions</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                             <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('forms.edit', $form) }}"
                                           class="flex items-center justify-center rounded-lg bg-white border border-slate-200 py-2.5 px-4 text-sm font-medium text-slate-700 transition-all hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit Form
                                        </a>
                                    @endif
                                    <a href="{{ route('forms.analytics', $form) }}"
                                       class="flex items-center justify-center rounded-lg bg-white border border-slate-200 py-2.5 px-4 text-sm font-medium text-slate-700 transition-all hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        Analytics
                                    </a>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                   <a href="#" 
                                    onclick="showQrModal('{{ route('forms.qrcode', $form) }}', '{{ $form->id }}')"
                                    class="flex items-center justify-center rounded-lg bg-slate-800 py-2.5 px-4 text-sm font-medium text-white transition-all hover:bg-slate-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <!-- SVG paths here -->
                                        </svg>
                                        QR Code
                                    </a>
                                            {{-- new things --}}

                                    <a href="{{ route('forms.show', $form) }}"
                                       target="_blank"
                                       class="flex items-center justify-center rounded-lg bg-slate-800 py-2.5 px-4 text-sm font-medium text-white transition-all hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Form
                                    </a>

                                    {{-- delete button   --}}
                                    @if(auth()->user()->hasRole('admin'))
                                        <form action="{{ route('forms.destroy', $form) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this form?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center justify-center rounded-lg bg-red-600 py-2.5 px-4 text-sm font-medium text-white transition-all hover:bg-red-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Delete Form
                                            </button>
                                        </form>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                   
                @endforeach
            </div>
        @endif
    </div>

     <div id="qrModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-semibold">Form QR Code</h3>
                <button onclick="closeQrModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div id="qrCodeContent" class="mb-4 flex justify-center"></div>
                <div class="flex justify-center">
                    <a id="qrDownloadButton" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        Download QR Code
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showQrModal(qrUrl, formId) {
            const modal = document.getElementById('qrModal');
            const qrContent = document.getElementById('qrCodeContent');
            const downloadBtn = document.getElementById('qrDownloadButton');
        
            
            qrContent.innerHTML = `<img src="${qrUrl}" class="w-64 h-64" alt="QR Code">`;
            
            
            downloadBtn.href = qrUrl;
            downloadBtn.download = `form-${formId}-qrcode.svg`;
            
         
            modal.classList.remove('hidden');
        }
        
        function closeQrModal() {
            document.getElementById('qrModal').classList.add('hidden');
        }
        
       
        window.onclick = function(event) {
            const modal = document.getElementById('qrModal');
            if (event.target === modal) {
                closeQrModal();
            }
        }
        </script>
    @vite('resources/js/app.js')
@endsection

