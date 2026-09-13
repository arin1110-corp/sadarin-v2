<script>
    document.addEventListener('DOMContentLoaded', function() {

        const internalButton = document.querySelector('[data-login-type="internal"]');
        const publicButton = document.querySelector('[data-login-type="public"]');

        const internalForm = document.querySelector('[data-login-form="internal"]');
        const publicForm = document.querySelector('[data-login-form="public"]');

        if (!internalButton || !publicButton || !internalForm || !publicForm) {
            return;
        }

        function activateButton(button, active) {

            if (active) {

                button.classList.remove(
                    'bg-white',
                    'text-navy-500',
                    'border-slate-200'
                );

                button.classList.add(
                    'bg-gradient-to-r',
                    'from-sadarin-500',
                    'to-blue-600',
                    'text-white',
                    'border-transparent',
                    'shadow-sm'
                );

            } else {

                button.classList.remove(
                    'bg-gradient-to-r',
                    'from-sadarin-500',
                    'to-blue-600',
                    'text-white',
                    'border-transparent',
                    'shadow-sm'
                );

                button.classList.add(
                    'bg-white',
                    'text-navy-500',
                    'border-slate-200'
                );
            }
        }


        function showLogin(type) {

            if (type === 'public') {

                internalForm.classList.add('hidden');
                publicForm.classList.remove('hidden');

                activateButton(internalButton, false);
                activateButton(publicButton, true);

            } else {

                publicForm.classList.add('hidden');
                internalForm.classList.remove('hidden');

                activateButton(publicButton, false);
                activateButton(internalButton, true);
            }

            localStorage.setItem('sadarin_login_type', type);
        }


        /*
        |--------------------------------------------------------------------------
        | PEGAWAI
        |--------------------------------------------------------------------------
        */

        internalButton.addEventListener('click', function() {
            showLogin('internal');
        });


        /*
        |--------------------------------------------------------------------------
        | PUBLIK
        |--------------------------------------------------------------------------
        */

        publicButton.addEventListener('click', function() {
            showLogin('public');
        });


        /*
        |--------------------------------------------------------------------------
        | DEFAULT
        |--------------------------------------------------------------------------
        */

        const savedType =
            localStorage.getItem('sadarin_login_type');

        showLogin(
            savedType === 'public' ?
            'public' :
            'internal'
        );

    });
</script>

@stack('scripts')
