<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    .star-rating-group {
        --star-size: 2rem;
        --empty-color: #e2e8f0;
        --filled-color: #f59e0b;
        --hover-color: #fbbf24;
    }

    .stars-container {
        display: inline-flex;
        gap: 0.25rem;
    }

    .star-btn {
        position: relative;
        cursor: pointer;
        width: var(--star-size);
        height: var(--star-size);
        background: none;
        border: none;
        padding: 0;
        transition: transform 0.2s ease;
    }

    .star-btn:hover {
        transform: scale(1.15);
    }

    .star-icon {
        font-size: var(--star-size);
        line-height: 1;
    }

    .empty-star {
        color: var(--empty-color);
    }

    .filled-star {
        color: var(--filled-color);
        display: none;
    }

    .star-btn.active .empty-star {
        display: none;
    }

    .star-btn.active .filled-star {
        display: inline;
    }

    /* Hover effect for all stars up to the current one */
    .star-btn:hover .empty-star,
    .star-btn:hover ~ .star-btn .empty-star {
        color: var(--hover-color);
    }
</style>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">{{ $form->title }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" 
                        class="absolute top-0 bottom-0 right-0 px-4 py-3"
                        onclick="this.parentElement.remove()">
                    <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
            </div>
        @endif

        <form method="POST" action="{{ route('forms.submit', $form) }}">
            @csrf

            @foreach($form->fields as $field)
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        {{ $field->label }}
                        @if($field->is_required)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    @if($field->type === 'text')
                        <input type="text" 
                               name="fields[{{ $field->id }}]" 
                               class="w-full p-2 border rounded"
                               @required($field->is_required)>

                    @elseif($field->type === 'date')
                        <input type="date" 
                               name="fields[{{ $field->id }}]"
                               class="w-full p-2 border rounded"
                               @required($field->is_required)>

                    @elseif($field->type === 'textarea')
                        <textarea name="fields[{{ $field->id }}]" 
                                  class="w-full p-2 border rounded"
                                  rows="4"
                                  @required($field->is_required)></textarea>

                    @elseif($field->type === 'radio')
                        <div class="space-y-2">
                            @foreach(json_decode($field->options) as $option)
                                <label class="flex items-center space-x-2">
                                    <input type="radio" 
                                           name="fields[{{ $field->id }}]" 
                                           value="{{ trim($option) }}"
                                           class="rounded-full"
                                           @required($field->is_required)>
                                    <span>{{ trim($option) }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif($field->type === 'checkbox')
                        <div class="space-y-2">
                            @foreach(json_decode($field->options) as $option)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" 
                                           name="fields[{{ $field->id }}][]" 
                                           value="{{ trim($option) }}"
                                           class="rounded">
                                    <span>{{ trim($option) }}</span>
                                </label>
                            @endforeach
                        </div>

                    @elseif($field->type === 'rating')
                        <div class="star-rating-group" data-field-id="{{ $field->id }}">
                            <div class="stars-container">
                                @for($i = 1; $i <= (int)$field->options; $i++)
                                    <button type="button" 
                                            class="star-btn"
                                            data-value="{{ $i }}">
                                        <span class="star-icon empty-star">☆</span>
                                        <span class="star-icon filled-star">★</span>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" 
                                   name="fields[{{ $field->id }}]" 
                                   value="0"
                                   @required($field->is_required)>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="my-8">
                <button type="submit" 
                        class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 font-semibold">
                    Submit Form
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.star-rating-group').forEach(group => {
        const stars = Array.from(group.querySelectorAll('.star-btn'));
        const hiddenInput = group.querySelector('input[type="hidden"]');

        function updateStars(rating) {
            stars.forEach((star, index) => {
                star.classList.toggle('active', index < rating);
            });
        }

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const value = index + 1;
                hiddenInput.value = value;
                updateStars(value);
            });

            // Hover effects
            star.addEventListener('mouseenter', () => {
                updateStars(index + 1);
            });
        });

        // Handle mouse leaving the container
        group.addEventListener('mouseleave', () => {
            updateStars(parseInt(hiddenInput.value) || 0);
        });

        // Initialize from existing value
        const initialValue = parseInt(hiddenInput.value) || 0;
        if (initialValue > 0) {
            updateStars(initialValue);
        }
    });
});
</script>
@endsection