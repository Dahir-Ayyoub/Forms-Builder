@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8" x-data="{
    fields: [],
    addField() {
        this.fields.push({
            label: '',
            type: 'text',
            options: [],
            is_required: false,
            order: this.fields.length
        });
    },
    removeField(index) {
        this.fields.splice(index, 1);
    },
    addOption(field) {
        field.options.push('');
    },
    removeOption(field, index) {
        field.options.splice(index, 1);
    }
}">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Create New Form</h1>
        
        <form method="POST" action="{{ route('forms.store') }}" class="space-y-6">
            @csrf
            
            <!-- Form Title -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <label class="block text-gray-700 text-sm font-semibold mb-3">
                    Form Title
                </label>
                <input type="text" name="title" 
                       class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="e.g. Customer Feedback Form"
                       required>
            </div>

            <!-- Dynamic Fields -->
            <div class="space-y-6">
                <template x-for="(field, index) in fields" :key="index">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold text-gray-700" x-text="'Field #' + (index + 1)"></h3>
                            <button type="button" 
                                    @click="removeField(index)"
                                    class="text-red-500 hover:text-red-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Field Label -->
                        <div class="mb-4">
                            <input type="text" 
                                   x-model="field.label"
                                   :name="`fields[${index}][label]`"
                                   placeholder="Field label"
                                   class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                   required>
                        </div>

                        <!-- Field Type -->
                        <div class="mb-4">
                            <select x-model="field.type" 
                                    :name="`fields[${index}][type]`"
                                    class="w-full p-2.5 border-2 border-gray-200 rounded-lg bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="text">Text Input</option>
                                <option value="date">Date</option>
                                <option value="textarea">Text Area</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="checkbox">Checkbox Group</option>
                                <option value="rating">Star Rating</option>
                            </select>
                        </div>

                        <!-- Field Options -->
                        <template x-if="['radio', 'checkbox', 'rating'].includes(field.type)">
                            <div class="mb-4 space-y-3">
                                <label class="block text-sm font-medium text-gray-700">
                                    Options
                                    <span x-show="field.type === 'rating'" class="text-gray-500 text-sm">(Max stars)</span>
                                </label>
                                
                                <template x-if="field.type !== 'rating'">
                                    <div class="space-y-2">
                                        <template x-for="(option, optIndex) in field.options" :key="optIndex">
                                            <div class="flex gap-2 items-center">
                                                <input type="text" 
                                                       x-model="field.options[optIndex]"
                                                       :name="`fields[${index}][options][${optIndex}]`"
                                                       placeholder="Option text"
                                                       class="flex-1 p-2 border-2 border-gray-200 rounded-lg"
                                                       required>
                                                <button type="button" 
                                                        @click="removeOption(field, optIndex)"
                                                        class="text-red-500 hover:text-red-700">
                                                    ✕
                                                </button>
                                            </div>
                                        </template>
                                        <button type="button" 
                                                @click="addOption(field)"
                                                class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Add Option
                                        </button>
                                    </div>
                                </template>

                                <template x-if="field.type === 'rating'">
                                    <input type="number" 
                                           x-model="field.options[0]"
                                           :name="`fields[${index}][options][0]`"
                                           min="1" max="10"
                                           class="w-full p-2.5 border-2 border-gray-200 rounded-lg"
                                           placeholder="Number of stars (1-10)"
                                           required>
                                </template>
                            </div>
                        </template>

                        <!-- Required Toggle -->
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" 
                                   x-model="field.is_required"
                                   :name="`fields[${index}][is_required]`"
                                   class="rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-600">Required field</span>
                        </label>
                    </div>
                </template>

                <!-- Add Field Button -->
                <button type="button" 
                        @click="addField()"
                        class="w-full py-3 px-6 bg-white border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-blue-500 hover:text-blue-600 transition-all duration-200">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Field
                </button>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-4">
                <a href="{{ route('forms.index') }}" 
                   class="px-6 py-2.5 border-2 border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                    Create Form
                </button>
            </div>
        </form>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</div>
@endsection


{{-- @extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{
        fields: [],
        addField() {
            this.fields.push({
                label: '',
                type: 'text',
                options: '',
                is_required: false,
                order: this.fields.length
            });
        },
        removeField(index) {
            this.fields.splice(index, 1);
        }
    }">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Create New Form</h1>
            
            <form method="POST" action="{{ route('forms.store') }}">
                @csrf
                
                <!-- Form Title -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Form Title
                    </label>
                    <input type="text" name="title" 
                           class="w-full p-3 border rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                           placeholder="Enter form title"
                           required>
                </div>

                <!-- Dynamic Fields -->
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-4">
                        Form Fields
                    </label>
                    
                    <template x-for="(field, index) in fields" :key="index">
                        <div class="bg-gray-50 p-4 rounded-lg mb-4 border border-gray-200">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-700" x-text="'Field ' + (index + 1)"></h3>
                                <button type="button" 
                                        @click="removeField(index)"
                                        class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Field Label -->
                            <div class="mb-3">
                                <input type="text" 
                                       x-model="field.label"
                                       :name="`fields[${index}][label]`"
                                       placeholder="Field label"
                                       class="w-full p-2 border rounded"
                                       required>
                            </div>

                            <!-- Field Type -->
                            <div class="mb-3">
                                <select x-model="field.type" 
                                        :name="`fields[${index}][type]`"
                                        class="w-full p-2 border rounded bg-white">
                                    <option value="text">Text Input</option>
                                    <option value="date">Date</option>
                                    <option value="textarea">Text Area</option>

                                    <option value="radio">Radio Buttons</option>
                                    <option value="checkbox">Checkbox Group</option>
                                    <option value="rating">Star Rating</option>
                                </select>
                            </div>

                            <!-- Field Options (for dropdown) -->
                            <div class="mb-3" x-show="field.type === 'select'">
                                <input type="text" 
                                       x-model="field.options"
                                       :name="`fields[${index}][options]`"
                                       placeholder="Comma-separated options (e.g., Option 1, Option 2)"
                                       class="w-full p-2 border rounded">
                            </div>

                            <div class="mb-3" x-show="['radio', 'checkbox', 'rating'].includes(field.type)">
                                <input type="text" 
                                       x-model="field.options"
                                       :name="`fields[${index}][options]`"
                                       placeholder="Comma-separated options (e.g., Option 1, Option 2)"
                                       class="w-full p-2 border rounded"
                                       x-bind:required="['radio', 'checkbox'].includes(field.type)">
                                <small class="text-gray-500" x-show="field.type === 'rating'">Enter max rating stars (e.g., 5)</small>
                            </div>

                            <!-- Required Toggle -->
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" 
                                       x-model="field.is_required"
                                       :name="`fields[${index}][is_required]`"
                                       class="rounded text-blue-500">
                                <span class="text-sm text-gray-600">Required field</span>
                            </label>

                            <!-- Hidden Order Field -->
                            <input type="hidden" 
                                   :name="`fields[${index}][order]`" 
                                   x-model="index">
                        </div>
                    </template>

                    <!-- Add Field Button -->
                    <button type="button" 
                            @click="addField()"
                            class="w-full py-2 px-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-gray-400 hover:text-gray-700 transition duration-200">
                        <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Field
                    </button>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('forms.index') }}" 
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
                        Create Form
                    </button>
                </div>
            </form>
        </div>

        <!-- Include Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>
    </div>

@endsection --}}