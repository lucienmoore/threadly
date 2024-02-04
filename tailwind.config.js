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
                'custom-blue' : '#0079D3',
                'custom-orange-hover': '#E65E44',
                'custom-orange-active': '#CA5742',
                'custom-input-focus': '#FF9D8A',
                'custom-avatar-media': '#FD8A75',
                'custom-bg' : '#DAE0E6',
                'custom-bg-vote' : '#F8F9FA',
                'custom-blue-arrow' : '#7193FF',
                'custom-button' : '#1B4EF7',
                'custom-card-hover' : '#898989',
                'custom-pagination-bg' : '#D6D8DC',
                primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
            }
        },
        fontFamily: {
        'body': [
            'Inter', 
            'ui-sans-serif', 
            'system-ui', 
            '-apple-system', 
            'system-ui', 
            'Segoe UI', 
            'Roboto', 
            'Helvetica Neue', 
            'Arial', 
            'Noto Sans', 
            'sans-serif', 
            'Apple Color Emoji', 
            'Segoe UI Emoji', 
            'Segoe UI Symbol', 
            'Noto Color Emoji'
            ],
        'sans': [
            'Inter', 
            'ui-sans-serif', 
            'system-ui', 
            '-apple-system', 
            'system-ui', 
            'Segoe UI', 
            'Roboto', 
            'Helvetica Neue', 
            'Arial', 
            'Noto Sans', 
            'sans-serif', 
            'Apple Color Emoji', 
            'Segoe UI Emoji', 
            'Segoe UI Symbol', 
            'Noto Color Emoji'
            ]
        }
    },

    plugins: [forms],
};
