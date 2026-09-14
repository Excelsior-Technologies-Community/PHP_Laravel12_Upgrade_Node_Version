import './bootstrap';


/*
|--------------------------------------------------------------------------
| Frontend Dashboard JavaScript
|--------------------------------------------------------------------------
|
| Features:
|
| 1. Dark mode
| 2. Accent themes
| 3. Dashboard search
| 4. Copy buttons
| 5. Refresh dashboard
| 6. Toast notifications
|
|--------------------------------------------------------------------------
*/


document.addEventListener('DOMContentLoaded', () => {

    const html = document.documentElement;

    const themeToggle =
        document.getElementById('themeToggle');

    const themeIcon =
        document.getElementById('themeIcon');

    const themeOptions =
        document.querySelectorAll('.theme-option');


    /*
    |--------------------------------------------------------------------------
    | Theme Mode
    |--------------------------------------------------------------------------
    */

    const savedMode =
        localStorage.getItem(
            'frontend-theme-mode'
        );


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


    if (savedMode) {

        applyMode(savedMode);

    } else {

        const prefersDark =
            window.matchMedia(
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
    | Toggle Dark Mode
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


    applyAccentTheme(
        savedColor || 'red'
    );


    themeOptions.forEach((button) => {

        button.addEventListener(
            'click',
            () => {

                applyAccentTheme(
                    button.dataset.theme
                );

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Dashboard Search
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById(
            'dashboardSearch'
        );


    const sections =
        document.querySelectorAll(
            '.dashboard-section'
        );


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            () => {

                const query =
                    searchInput.value
                        .toLowerCase()
                        .trim();


                sections.forEach((section) => {

                    const searchableText =
                        (
                            section.dataset.search
                            || section.innerText
                        ).toLowerCase();


                    if (
                        query === ''
                        || searchableText.includes(query)
                    ) {

                        section.classList.remove(
                            'hidden'
                        );

                    } else {

                        section.classList.add(
                            'hidden'
                        );

                    }

                });

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Copy Buttons
    |--------------------------------------------------------------------------
    */

    const copyButtons =
        document.querySelectorAll(
            '.copy-btn, .command-copy'
        );


    const showToast = (message = 'Copied!') => {

        const toast =
            document.getElementById('toast');


        if (!toast) {
            return;
        }


        toast.textContent = message;

        toast.classList.remove(
            'hidden'
        );


        setTimeout(() => {

            toast.classList.add(
                'hidden'
            );

        }, 1800);

    };


    copyButtons.forEach((button) => {

        button.addEventListener(
            'click',
            async () => {

                const value =
                    button.dataset.copy
                    || button.textContent.trim();


                try {

                    await navigator.clipboard.writeText(
                        value
                    );

                    showToast(
                        'Copied to clipboard!'
                    );

                } catch (error) {

                    showToast(
                        'Copy failed'
                    );

                }

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Refresh Dashboard
    |--------------------------------------------------------------------------
    */

    const refreshButton =
        document.getElementById(
            'refreshDashboard'
        );


    if (refreshButton) {

        refreshButton.addEventListener(
            'click',
            () => {

                refreshButton.disabled = true;

                refreshButton.innerHTML =
                    '⏳ Refreshing...';


                window.location.reload();

            }
        );

    }


});