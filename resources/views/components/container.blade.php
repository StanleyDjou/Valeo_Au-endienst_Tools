<div
    {{ $attributes->merge([
            'class' => 'max-w-screen-xl flex-grow mx-auto px-4',
    ]) }}
>
    {{ $slot }}
</div>
