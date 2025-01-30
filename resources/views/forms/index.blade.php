@extends('layouts.app')
@section('content')
<style>
    #qrModal {
        backdrop-filter: blur(5px);
        background-color: rgba(0, 0, 0, 0.6);
        transition: opacity 0.2s ease-in-out;
    }

    #qrModal img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
    }

    .form-card {
        transform: translateY(0);
        transition: all 0.3s ease-in-out;
    }

    .form-card:hover {
        transform: translateY(-4px);
    }

    .stats-item {
        transition: all 0.2s ease-in-out;
    }

    .stats-item:hover {
        background-color: #f8fafc;
        transform: scale(1.02);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Your Forms</h1>
            @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('forms.create') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Form
            </a>
            @endif
        </div>

        @if($forms->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-8 text-center border border-slate-200">
            <div class="w-24 h-24 bg-slate-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <p class="text-lg text-slate-600">
                @if(auth()->user()->hasRole('admin'))
                You haven't created any forms yet.
                @else
                No forms have been assigned to you yet.
                @endif
            </p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($forms as $form)
            <div class="form-card bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6">
                    <!-- Status Badge -->
                    <div class="flex justify-between items-start mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                            Active
                        </span>
                        <span class="text-sm text-slate-500">{{ $form->created_at->format('M d, Y') }}</span>
                    </div>

                    <!-- Form Info -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-slate-800 mb-2 truncate">{{ $form->title }}</h2>
                        @if($form->client)
                        <div class="flex items-center text-slate-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm">{{ $form->client->name }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="stats-item bg-slate-50 rounded-xl p-4 text-center">
                            <div class="flex items-center justify-center text-blue-600 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-slate-800">{{ $form->views_count }}</p>
                            <p class="text-sm text-slate-600">Views</p>
                        </div>
                        <div class="stats-item bg-slate-50 rounded-xl p-4 text-center">
                            <div class="flex items-center justify-center text-green-600 mb-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-slate-800">{{ $form->submissions_count }}</p>
                            <p class="text-sm text-slate-600">Submissions</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('forms.edit', $form) }}"
                                class="flex items-center justify-center rounded-xl bg-white border border-slate-200 py-2.5 px-4 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            @endif
                            <a href="{{ route('forms.analytics', $form) }}"
                                class="flex items-center justify-center rounded-xl bg-white border border-slate-200 py-2.5 px-4 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Analytics
                            </a>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="showQrModal('{{ route('forms.qrcode', $form) }}', '{{ $form->id }}')"
                                class="flex items-center justify-center rounded-xl bg-slate-800 py-2.5 px-4 text-sm font-medium text-white hover:bg-slate-700 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                QR Code
                            </button>
                            <a href="{{ route('forms.show', $form) }}" target="_blank"
                                class="flex items-center justify-center rounded-xl bg-blue-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-blue-700 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                        </div>

                        @if(auth()->user()->hasRole('admin'))
                        <form action="{{ route('forms.destroy', $form) }}" method="POST" class="mt-3"
                            onsubmit="return confirm('Are you sure you want to delete this form?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center justify-center rounded-xl bg-red-600 py-2.5 px-4 text-sm font-medium text-white hover:bg-red-700 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Form
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- QR Modal -->
{{-- <div id="qrModal" class="hidden fixed inset-0 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md transform transition-all">
        <div class="flex justify-between items-center p-6 border-b border-slate-200">
            <h3 class="text-xl font-semibold text-slate-800">Form QR Code</h3>
            <button onclick="closeQrModal()" class="text-slate-400 hover:text-slate-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div id="qrCodeContent" class="mb-6 flex justify-center"></div>
            <div class="flex justify-center">
                <a id="qrDownloadButton"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download QR Code
                </a>
            </div>
        </div>
    </div>
</div> --}}


<div id="qrModal" class="fixed inset-0 flex items-center justify-center z-50 p-4 opacity-0 invisible transition-opacity duration-200">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md transform transition-all">
        <div class="flex justify-between items-center p-6 border-b border-slate-200">
            <h3 class="text-xl font-semibold text-slate-800">Form QR Code</h3>
            <button onclick="closeQrModal()" class="text-slate-400 hover:text-slate-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div id="qrCodeContent" class="mb-6 flex justify-center"></div>
            <div class="flex justify-center">
                <a id="qrDownloadButton"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
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
        
        // Reset modal content
        qrContent.innerHTML = `
            <div class="animate-pulse">
                <div class="w-64 h-64 bg-slate-200 rounded-lg"></div>
            </div>
        `;
    
        // Load QR code image
        const img = new Image();
        img.src = qrUrl;
        img.className = 'w-64 h-64 rounded-lg shadow-sm';
        
        img.onload = function() {
            qrContent.innerHTML = '';
            qrContent.appendChild(img);
        };
    
        img.onerror = function() {
            qrContent.innerHTML = '<p class="text-red-500">Error loading QR code</p>';
        };
    
        // Set up download button
        downloadBtn.href = qrUrl;
        downloadBtn.download = `form-${formId}-qrcode.png`; // Changed to .png (update based on your actual file type)
    
        // Show modal
        modal.classList.remove('invisible', 'opacity-0');
        modal.classList.add('opacity-100');
    
        // Add escape key listener
        document.addEventListener('keydown', handleEscapeKey);
    }
    
    function closeQrModal() {
        const modal = document.getElementById('qrModal');
        
        // Hide modal with transition
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        
        setTimeout(() => {
            modal.classList.add('invisible');
        }, 200); // Match the transition duration
    
        // Remove escape key listener
        document.removeEventListener('keydown', handleEscapeKey);
    }
    
    function handleEscapeKey(event) {
        if (event.key === 'Escape') {
            closeQrModal();
        }
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('qrModal');
        if (event.target === modal) {
            closeQrModal();
        }
    }
    </script>
    @vite('resources/js/app.js')
    @endsection

{{-- <script>
function showQrModal(qrUrl, formId) {
    const modal = document.getElementById('qrModal');
    const qrContent = document.getElementById('qrCodeContent');
    const downloadBtn = document.getElementById('qrDownloadButton');
    
    // Add a loading state
    qrContent.innerHTML = `
        <div class="animate-pulse">
            <div class="w-64 h-64 bg-slate-200 rounded-lg"></div>
        </div>
    `;
    
    // Load the QR code image
    const img = new Image();
    img.src = qrUrl;
    img.className = 'w-64 h-64 rounded-lg shadow-sm';
    img.onload = function() {
        qrContent.innerHTML = '';
        qrContent.appendChild(img);
    };
    
    // Setup download button
    downloadBtn.href = qrUrl;
    downloadBtn.download = `form-${formId}-qrcode.svg`;
    
    // Show modal with animation
    modal.classList.remove('hidden');
    modal.classList.add('animate-fadeIn');
    
    // Add escape key listener
    document.addEventListener('keydown', handleEscapeKey);
}

function closeQrModal() {
    const modal = document.getElementById('qrModal');
    
    // Add fade out animation
    modal.classList.add('animate-fadeOut');
    
    // Remove modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('animate-fadeOut');
    }, 200);
    
    // Remove escape key listener
    document.removeEventListener('keydown', handleEscapeKey);
}

function handleEscapeKey(event) {
    if (event.key === 'Escape') {
        closeQrModal();
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('qrModal');
    if (event.target === modal) {
        closeQrModal();
    }
}

// Add custom animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }
    
    .animate-fadeOut {
        animation: fadeOut 0.2s ease-out;
    }
`;
document.head.appendChild(style);
</script>
@vite('resources/js/app.js')
@endsection --}}