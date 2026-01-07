/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.{js,ts,jsx,tsx}",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            keyframes: {
                'marquee-left': {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(-100%)' },
                },
                'marquee-right': {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(0)' },
                },
            },
            animation: {
                'marquee-left': 'marquee-left 80s linear infinite',
                'marquee-right': 'marquee-right 80s linear infinite',
            },
        },
    },
    plugins: [],
}