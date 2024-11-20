<x-guest-layout>
    <form id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Middle Name -->
        <div class="mt-4">
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autocomplete="middle_name" />
            <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="date_of_birth" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Department ID -->
        <div class="mt-4">
            <x-input-label for="department_id" :value="__('Department ID')" />
            <select id="department_id" name="department_id" class="block mt-1 w-full" required>
                <option value="">-- Not selected --</option>
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button id="registerButton" class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Применение маски ввода к полю phone
            $('#phone').inputmask('+7 (999) 999-99-99');

            // Загрузка данных о департаментах
            $.ajax({
                url: '/api/department/all',
                method: 'GET',
                success: function(response) {
                    const departments = response;
                    const departmentSelect = $('#department_id');

                    // Создаем массив элементов option
                    const options = departments.map(function(department) {
                        return new Option(department.department_name, department.department_id);
                    });

                    // Добавляем элементы option в выпадающий список
                    departmentSelect.append(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading departments:', error);
                }
            });

            // Валидация формы перед отправкой
            $('#registerForm').on('submit', function(event) {
                event.preventDefault();

                // Проверка обязательных полей
                const firstName = $('#first_name').val();
                const lastName = $('#last_name').val();
                const dateOfBirth = $('#date_of_birth').val();
                const phone = $('#phone').val();
                const departmentId = $('#department_id').val();
                const email = $('#email').val();
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();

                if (!firstName || !lastName || !dateOfBirth || !phone || !email || !password || !passwordConfirmation) {
                    alert('Please fill in all required fields.');
                    return;
                }

                if (password !== passwordConfirmation) {
                    alert('Passwords do not match.');
                    return;
                }

                if (departmentId === 0) {
                    alert('Please select a department.');
                    return;
                }

                // Отправка формы через AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Registration successful!');
                        window.location.href = '/dashboard'; // Перенаправление на главную страницу
                    },
                    error: function(xhr, status, error) {
                        alert('Registration failed: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</x-guest-layout>