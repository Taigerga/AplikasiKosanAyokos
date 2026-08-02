<div class="border-2 border-black rounded-lg overflow-hidden">
    <div class="bg-gray-100 border-b-2 border-black p-3">
        <div class="skeleton h-5 w-1/3"></div>
    </div>
    @for ($i = 0; $i < ($rows ?? 5); $i++)
    <div class="flex gap-4 p-3 {{ $i < ($rows ?? 5) - 1 ? 'border-b border-gray-200' : '' }}">
        <div class="skeleton h-4 w-1/4"></div>
        <div class="skeleton h-4 w-1/4"></div>
        <div class="skeleton h-4 w-1/6"></div>
        <div class="skeleton h-4 w-1/6"></div>
    </div>
    @endfor
</div>
