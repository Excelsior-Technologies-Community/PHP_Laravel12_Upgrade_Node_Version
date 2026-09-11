import './bootstrap';


/*
|--------------------------------------------------------------------------
| Theme Manager
|--------------------------------------------------------------------------
|
| Handles:
| - Light/Dark mode
| - Accent theme
| - LocalStorage persistence
|
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    const html = document.documentElement;

    const themeToggle = document.getElementById('themeToggle');

    const themeIcon = document.getElementById('themeIcon');

    const themeOptions = document.querySelectorAll(
        '.theme-option'
    );


    /*
    |--------------------------------------------------------------------------
    | Load Saved Theme Mode
    |--------------------------------------------------------------------------
    */

    const savedMode = localStorage.getItem(
        'frontend-theme-mode'
    );


    /*
    |--------------------------------------------------------------------------
    | Apply Theme Mode
    |--------------------------------------------------------------------------
    */

    const applyMode = (mode) => {

        if (mode === 'dark') {

            html.classList.add('dark');

            if (themeIcon) {
                themeIcon.textContent = '☀️';
            }

        } else {

            html.classList.remove('dark');

            if (themeIcon) {
                themeIcon.textContent = '🌙';
            }
        }

        localStorage.setItem(
            'frontend-theme-mode',
            mode
        );
    };


    /*
    |--------------------------------------------------------------------------
    | Initial Mode
    |--------------------------------------------------------------------------
    */

    if (savedMode) {

        applyMode(savedMode);

    } else {

        const prefersDark = window.matchMedia(
            '(prefers-color-scheme: dark)'
        ).matches;

        applyMode(
            prefersDark
                ? 'dark'
                : 'light'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Light / Dark
    |--------------------------------------------------------------------------
    */

    if (themeToggle) {

        themeToggle.addEventListener(
            'click',
            () => {

                const isDark =
                    html.classList.contains('dark');

                applyMode(
                    isDark
                        ? 'light'
                        : 'dark'
                );

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Accent Theme
    |--------------------------------------------------------------------------
    */

    const savedColor =
        localStorage.getItem(
            'frontend-accent-theme'
        );


    const applyAccentTheme = (theme) => {

        html.dataset.theme = theme;

        localStorage.setItem(
            'frontend-accent-theme',
            theme
        );

        themeOptions.forEach((button) => {

            button.classList.remove(
                'ring-4',
                'ring-offset-2',
                'ring-slate-400'
            );

            if (
                button.dataset.theme === theme
            ) {

                button.classList.add(
                    'ring-4',
                    'ring-offset-2',
                    'ring-slate-400'
                );
            }
        });
    };


    /*
    |--------------------------------------------------------------------------
    | Initial Accent Theme
    |--------------------------------------------------------------------------
    */

    applyAccentTheme(
        savedColor || 'red'
    );


    /*
    |--------------------------------------------------------------------------
    | Theme Selection
    |--------------------------------------------------------------------------
    */

    themeOptions.forEach((button) => {

        button.addEventListener(
            'click',
            () => {

                const theme =
                    button.dataset.theme;

                applyAccentTheme(theme);

            }
        );

    });

});