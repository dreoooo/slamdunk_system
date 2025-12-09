<div class="bg-white rounded-lg shadow p-6 mb-6">
    @if (isset($title))
        <h3 class="text-lg font-bold mb-4">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
