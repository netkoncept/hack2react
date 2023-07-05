@props(['id', 'checked','disabled'])

@php
    $classes = 'text-blue-600 bg-gray-100 cursor-pointer';
    if ($disabled) {
        $classes = 'bg-gray-50 text-gray-300 cursor-not-allowed';
    }
@endphp

<div class="flex items-center mb-1">
    <input id="{{ $id }}"
           type="checkbox"
           {!! $attributes->merge(['class' => 'w-4 h-4 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 '. $classes]) !!}
           @if($checked) checked @endif
           @if($disabled) disabled @endif
    >
    <label for="{{ $id }}" class="ml-2 font-medium text-gray-900">{{ $slot }}</label>
</div>
