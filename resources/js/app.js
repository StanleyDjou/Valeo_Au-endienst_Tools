import Alpine from 'alpinejs';
import 'flowbite';
import "tw-elements";


require('./bootstrap');

window.Alpine = Alpine;

queueMicrotask(() => {
    Alpine.start()
});
