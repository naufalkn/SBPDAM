<a href="{{ $href }}" class="w-full flex items-center space-x-2 rounded {{ $isActive ? 'bg-blue-700 text-gray-50' : 'hover:bg-gray-200 hover:text-black' }}">
    <div class="w-11 h-10 py-2 px-4 flex items-center space-x-2 rounded">
        <i class="{{ $icon }} {{ $isActive ? 'text-white' : 'text-blue-700' }}"></i>
    </div>
    <span class="font-semibold tracking-wide {{ $isActive ? 'text-white' : 'text-blue-700' }}">{{ $text }}</span>
</a>
