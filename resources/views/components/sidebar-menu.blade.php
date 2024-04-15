<a href="{{ $href }}" class="w-full flex items-center space-x-2 hover:bg-gray-200 rounded {{ $isActive ? 'bg-blue-700 text-gray-50 hover:bg-gray-100 hover:text-black' : ''}}">
    <div class="w-11 h-10 py-2 px-4 flex items-center space-x-2 rounded">
        <i class="{{ $icon }} {{ $isActive ? 'text-white ' : 'text-blue-600' }}"></i>
    </div>
    <span>{{ $text }}</span>
</a>