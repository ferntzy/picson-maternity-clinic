module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui'], // default UI
                poppins: ['Poppins', 'sans-serif'], // for big texts
            },
        },
    },
    plugins: [],
};
