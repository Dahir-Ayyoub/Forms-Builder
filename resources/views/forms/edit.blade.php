{{-- @extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8" x-data="{
    fields: @js($form->fields->map(function($field) {
        return [
            'label' => $field->label,
            'type' => $field->type,
            'options' => $field->type === 'rating' ? [(string)$field->options] : explode(',', $field->options),
            'is_required' => $field->is_required,
            'order' => $field->order
        ];
    })),
    addField() {
        this.fields.push({
            label: '',
            type: 'text',
            options: [],
            is_required: false,
            order: this.fields.length
        });
    },
    addOption(field) {
        field.options.push('');
    },
    removeOption(field, index) {
        field.options.splice(index, 1);
    }
}">
    <form method="POST" action="{{ route('forms.update', $form) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Form Title -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <input type="text" name="title" value="{{ $form->title }}" 
                   class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                   placeholder="Form Title"
                   required>
        </div>

        <!-- Fields Container -->
        <div class="space-y-6">
            <template x-for="(field, index) in fields" :key="index">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-semibold text-gray-700">Field #<span x-text="index + 1"></span></h3>
                        <button type="button" 
                                @click="fields.splice(index, 1)" 
                                class="text-red-500 hover:text-red-700">
                            ✕
                        </button>
                    </div>

                    <!-- Field Label -->
                    <input type="text" 
                           x-model="field.label"
                           :name="`fields[${index}][label]`" 
                           placeholder="Label" 
                           class="w-full p-2.5 border-2 border-gray-200 rounded-lg mb-4"
                           required>

                    <!-- Field Type -->
                    <select x-model="field.type" 
                            :name="`fields[${index}][type]`" 
                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg mb-4">
                        <option value="text">Text Input</option>
                        <option value="date">Date</option>
                        <option value="textarea">Text Area</option>
                        <option value="radio">Radio Buttons</option>
                        <option value="checkbox">Checkbox Group</option>
                        <option value="rating">Star Rating</option>
                    </select>

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
                        <span class="text-sm text-gray-600">Required</span>
                    </label>
                </div>
            </template>

            <button type="button" 
                    @click="addField()"
                    class="w-full py-3 px-6 bg-white border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-blue-500 hover:text-blue-600">
                + Add New Field
            </button>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3 px-6 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-semibold transition-colors">
            Update Form
        </button>
    </form>
    @vite('resources/js/app.js')
</div>
@endsection --}}




@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8" x-data="{
    fields: @js($form->fields->map(function($field) {
        return [
            'label' => $field->label,
            'type' => $field->type,
            'options' => $field->type === 'rating' ? [(string)$field->options] : json_decode($field->options), // Decode JSON for options
            'is_required' => $field->is_required,
            'order' => $field->order
        ];
    })),
    addField() {
        this.fields.push({
            label: '',
            type: 'text',
            options: [],
            is_required: false,
            order: this.fields.length
        });
    },
    addOption(field) {
        field.options.push('');
    },
    removeOption(field, index) {
        field.options.splice(index, 1);
    }
}">
    <form method="POST" action="{{ route('forms.update', $form) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Form Title -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <input type="text" name="title" value="{{ $form->title }}" 
                   class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                   placeholder="Form Title"
                   required>
        </div>

        <!-- Fields Container -->
        <div class="space-y-6">
            <template x-for="(field, index) in fields" :key="index">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-semibold text-gray-700">Field #<span x-text="index + 1"></span></h3>
                        <button type="button" 
                                @click="fields.splice(index, 1)" 
                                class="text-red-500 hover:text-red-700">
                            ✕
                        </button>
                    </div>

                    <!-- Field Label -->
                    <input type="text" 
                           x-model="field.label"
                           :name="`fields[${index}][label]`" 
                           placeholder="Label" 
                           class="w-full p-2.5 border-2 border-gray-200 rounded-lg mb-4"
                           required>

                    <!-- Field Type -->
                    <select x-model="field.type" 
                            :name="`fields[${index}][type]`" 
                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg mb-4">
                        <option value="text">Text Input</option>
                        <option value="date">Date</option>
                        <option value="textarea">Text Area</option>
                        <option value="radio">Radio Buttons</option>
                        <option value="checkbox">Checkbox Group</option>
                        <option value="rating">Star Rating</option>
                    </select>

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
                        <span class="text-sm text-gray-600">Required</span>
                    </label>
                </div>
            </template>

            <button type="button" 
                    @click="addField()"
                    class="w-full py-3 px-6 bg-white border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:border-blue-500 hover:text-blue-600">
                + Add New Field
            </button>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3 px-6 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-semibold transition-colors">
            Update Form
        </button>
    </form>
    @vite('resources/js/app.js')
</div>
@endsection



{{-- @extends('layouts.app')
@section('content')

    <div class="container mx-auto px-4" x-data="{ fields: @js($form->fields->toArray()) }">
        <form method="POST" action="{{ route('forms.update', $form) }}">
            @csrf
            @method('PUT')
            
            <input type="text" name="title" value="{{ $form->title }}" 
                   class="w-full mb-4 p-2 border rounded" placeholder="Form Title">

            <template x-for="(field, index) in fields" :key="index">
                <div class="mb-4 p-4 border rounded">
                    <input type="text" x-model="field.label" 
                           :name="`fields[${index}][label]`" 
                           placeholder="Label" 
                           class="w-full mb-2 p-2 border rounded">

                    <select x-model="field.type" 
                            :name="`fields[${index}][type]`" 
                            class="w-full mb-2 p-2 border rounded">
                            <option value="text">Text Input</option>
                            <option value="date">Date</option>
                            <option value="textarea">Text Area</option>

                            <option value="radio">Radio Buttons</option>
                            <option value="checkbox">Checkbox Group</option>
                            <option value="rating">Star Rating</option>
                    </select>

                    <input x-show="field.type === 'select'" 
                           type="text" 
                           x-model="field.options" 
                           :name="`fields[${index}][options]`" 
                           placeholder="Options (comma-separated)" 
                           class="w-full mb-2 p-2 border rounded">

                           <input x-show="['radio', 'checkbox', 'rating'].includes(field.type)"
                           type="text" 
                           x-model="field.options" 
                           :name="`fields[${index}][options]`" 
                           placeholder="Options (comma-separated or number for rating)" 
                           class="w-full mb-2 p-2 border rounded">

                    <label class="block mb-2">
                        <input type="checkbox" 
                               x-model="field.is_required" 
                               :name="`fields[${index}][is_required]`"> Required
                    </label>
                    
                    <input type="hidden" :name="`fields[${index}][order]`" x-model="index">
                    <button type="button" @click="fields.splice(index, 1)" 
                            class="text-red-500">Remove</button>
                </div>
            </template>

            <button type="button" 
                    @click="fields.push({ label: '', type: 'text', options: '', is_required: false })" 
                    class="bg-blue-500 text-white p-2 rounded">
                Add Field
            </button>

            <button type="submit" class="bg-green-500 text-white p-2 rounded mt-4">
                Update Form
            </button>
        </form>
    </div>
    @vite('resources/js/app.js')
    @endsection --}}
