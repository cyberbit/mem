<div class="alert alert-{{ $context }}">
    @isset($title)
        <h4 class="alert-heading">{{ $title }}</h4>
    @endisset
    
    {{ $slot }}
</div>