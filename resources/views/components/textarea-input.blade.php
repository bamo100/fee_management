@props([
    'label',
    'id',
    'model',
    'validation' => null,
    'errorKey' => null,
    'rows' => 3,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea
        id="{{ $id }}"
        x-model="{{ $model }}"
        @if($validation)
            @change="{{ $validation }}('{{ $errorKey ?? $id }}')"
        @endif
        rows="{{ $rows }}"
        class="border-gray-300 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    ></textarea>
    <div x-show="errors.{{ $errorKey ?? $id }}" x-text="errors.{{ $errorKey ?? $id }}" class="text-danger"></div>
</div>
