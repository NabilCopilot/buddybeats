@props(['class' => ''])

<form method="POST" action="{{ route('logout') }}" class="{{ $class }}">
    @csrf
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
        {{ $slot }}
    </a>
</form>
