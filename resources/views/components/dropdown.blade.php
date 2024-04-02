@props(['align' => 'left', 'width' => '72', 'contentClasses' => 'py-1 bg-secondary','position'=>'absolute'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right -right-16 md:right-0';
        break;
}

switch ($width) {
    case '72':
        $width = 'w-72';
        break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class=" {{$position}} z-50 mt-2 max-h-screen(-16)  overflow-x-auto {{ $width }} rounded-md pt-3 rounded-b-lg  {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
            <div class="rounded-bl-lg  ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
                {{ $content }}
            </div>
    </div>
</div>
