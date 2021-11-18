<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <div class="w-80">
           <x-jet-authentication-card-logo />
           </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />


        <form method="POST" action="{{ route('register') }}" class="mt-6">
            @csrf
            <div>
                <label class="block text-gray-700">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="" placeholder="" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-primary-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
            </div>
            
            <div class="mt-4">
                <label class="block text-gray-700">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="" placeholder="Enter Your Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-primary-500 focus:bg-white focus:outline-none" autofocus autocomplete required>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-primary-500
                  focus:bg-white focus:outline-none" required autocomplete="new-password">
            </div>
            <div class="mt-4">
                <label class="block text-gray-700">Password Confirmation <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-primary-500
                  focus:bg-white focus:outline-none" required autocomplete="new-password">
            </div>

            <div class="hidden mt-4 form-control w-full">
                <label class="block text-gray-700">Gender</label>
                <select class="select select-bordered rounded-lg bg-gray-200 mt-2 w-full">
                    <option disabled="disabled" selected="selected">---</option>
                    <option>M</option>
                    <option>F</option>
                </select>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700">Phone</label>
                <input type="text" name="phone" id="" placeholder="Enter Your Phone" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-primary-500 focus:bg-white focus:outline-none" required>
            </div>
            <input type="hidden" name="merchant_id" value="34">
            @if(true)
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('t&c').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms and Conditions').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
{{-- 
            <div class="text-right mt-2">
                <a href="#" class="text-sm font-semibold text-gray-700 hover:text-primary focus:text-primary-focus">Forgot Password?</a>
            </div> --}}

            <button type="submit" class="uppercase w-full block bg-primary hover:bg-primary-focus focus:bg-primary-focus text-white font-semibold rounded-lg
                px-4 py-3 mt-6">Register</button>
        </form>


        <!-- <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form> -->
    </x-jet-authentication-card>
</x-guest-layout>
