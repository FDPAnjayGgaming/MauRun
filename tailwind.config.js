import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50:  '#f4f9f0',
                    100: '#e5f0dc',
                    200: '#cbdfbb',
                    300: '#a6c991',
                    400: '#7fae66',
                    500: '#5f9244',
                    600: '#4c7636',
                    700: '#3d5c2c',
                    800: '#334a27',
                    900: '#2c3f23',
                    950: '#142210',
                },
                accent: {
                    50:  '#effcfd',
                    100: '#d5f5f8',
                    200: '#afeaf2',
                    300: '#78d9e8',
                    400: '#3ac0d5',
                    500: '#1fa3b5',
                    600: '#1c8598',
                    700: '#1d6c7c',
                    800: '#215966',
                    900: '#1e4b56',
                    950: '#0d3039',
                },
                sidebar: {
                    DEFAULT: '#0f172a',
                    light:   '#1e293b',
                    hover:   '#334155',
                    active:  '#1e4b56',
                },
            },
            animation: {
                'fade-in':    'fadeIn 0.5s ease-out',
                'slide-up':   'slideUp 0.4s ease-out',
                'slide-in-r': 'slideInRight 0.4s ease-out',
                'counter':    'counter 1.5s ease-out',
                'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%':   { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInRight: {
                    '0%':   { opacity: '0', transform: 'translateX(20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '1' },
                    '50%':      { opacity: '0.8' },
                },
            },
            boxShadow: {
                'card':    '0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04)',
                'card-lg': '0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -1px rgba(0,0,0,0.04)',
                'glow':    '0 0 15px rgba(31, 163, 181, 0.15)',
            },
        },
    },

    plugins: [forms],
};
