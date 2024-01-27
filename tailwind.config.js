import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                'custom-orange': '#FF684D',
                'custom-orange-hover': '#E65E44',
                'custom-orange-active': '#CA5742',
                'custom-input-focus': '#FF9D8A',
                'custom-avatar-media': '#FD8A75',
                'custom-bg' : '#DAE0E6',
                'custom-bg-vote' : '#F8F9FA',
                'custom-button' : '#1B4EF7'
            }
        },
    },

    plugins: [forms],
};
