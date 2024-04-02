<a
    {{ $attributes->merge([
            'class' => 'max-w-screen-xl flex-grow mx-auto px-4 mx-auto',
    ]) }}
>
    {{ $slot }}
</a>
