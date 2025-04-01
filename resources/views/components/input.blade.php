@props([
    'label',
    'type' => 'text',
    'id',
    'model',
    'validation' => null,
    'errorKey' => null,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        x-model="{{ $model }}"
        @if($validation)
            @change="{{ $validation }}('{{ $errorKey ?? $id }}')"
        @endif
        class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    >
    <div x-show="errors.{{ $errorKey ?? $id }}" x-text="errors.{{ $errorKey ?? $id }}" class="text-danger"></div>
</div>
