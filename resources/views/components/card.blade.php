@props(['link','text','subText'])
<div class="flex">
    <a href="{{ $link }}" class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $text }}</h5>
        <p class="font-normal text-gray-700">{{ $subText }}</p>
    </a>
</div>
