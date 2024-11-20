<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 grid grid-cols-2 md:grid-cols-2 gap-6">
        @csrf
        @method('patch')

        <!-- Left Column -->
        <div class="space-y-6">
            <!-- Last Name -->
            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $employee->last_name)" required autocomplete="last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>

            <!-- First Name -->
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $employee->first_name)" required autofocus autocomplete="first_name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <!-- Middle Name -->
            <div>
                <x-input-label for="middle_name" :value="__('Middle Name')" />
                <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $employee->middle_name)" autocomplete="middle_name" />
                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
            </div>

            <!-- Date of Birth -->
            <div>
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '')" required autocomplete="date_of_birth" />
                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Phone -->
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $employee->phone)" required autocomplete="phone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Department -->
            <div>
                <x-input-label for="department_id" :value="__('Department')" />
                <select id="department_id" name="department_id" class="block mt-1 w-full" required>
                    <option value="">-- Select Department --</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->department_id }}" {{ $currentDepartment && $currentDepartment->department_id == $department->department_id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
            </div>

            <!-- Role -->
            <div>
                <x-input-label for="role_id" :value="__('Role')" />
                <select id="role_id" name="role_id" class="block mt-1 w-full" required>
                    <option value="">-- Select Role --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->role_id }}" {{ $currentRole && $currentRole->role_id == $role->role_id ? 'selected' : '' }}>
                        {{ $role->role_name }}
                    </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $employee->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($employee instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $employee->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <div class="col-span-full flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>