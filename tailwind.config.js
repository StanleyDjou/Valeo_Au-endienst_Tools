const defaultTheme = require('tailwindcss/defaultTheme');

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./node_modules/flowbite/**/*.js",
        "./resources/**/*.vue",
        "./src/**/*.{html,js}",
        "./node_modules/tw-elements/dist/js/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Barlow', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'secondary': '#0488DD',
                'secondary-2': '#0488DD',
                'secondary-50': '#797979',
                'secondary-100': '#C1C8F0',
                'secondary-400': '#2A9AE2',
                'secondary-200': '#98A5E7',
                'secondary-700': '#0039B7',
                'secondary-800': '#002FAC',
                'secondary-900': '#001B9A',
                'dark-400' : '#424242',
                'input-light': 'rgba(255, 255, 255, 0.1)',
                'footer': '#001333',
                'light': '#E1F1FB',
                'light-blue': '#E1F1FB',
                'light-orange' : '#FFF3E3',
                'danger': '#EE4B49',
                'danger-600': '#F87171',
                'orange': '#ff9719'
            },

            height: {
                'input' : '51px',
            },
            safelist: ['animate-[fade-in_1s_ease-in-out]', 'animate-[fade-in-down_1s_ease-in-out]', 'animate-[slide-right_1s_ease-in-out]'],
        },
        plugins: [
            require('flowbite/plugin'),
            require("tw-elements/dist/plugin.cjs"),
        ],
        darkMode: "class"
    }
}
