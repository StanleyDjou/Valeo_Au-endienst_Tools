<a
    {{ $attributes->merge([
            'class' => 'inline-flex nowrap  items-center px-5 text-white border-2 border-secondary-300 rounded-md  bg-gradient-to-b from-secondary-300 to-secondary-300/0 hover:opacity-75',
    ]) }}
>
    {{ $slot }}
</a>
