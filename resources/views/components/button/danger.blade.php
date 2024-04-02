<a
    {{ $attributes->merge([
        'class' => 'inline-flex nowrap items-center px-4 py-3 text-white border-none rounded-xl bg-danger hover:opacity-75',
    ]) }}>
    {{ $slot }}
</a>
