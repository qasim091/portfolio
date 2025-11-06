<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">{{ __("Welcome back, :name!", ['name' => Auth::user()->name]) }}</h3>
                    <p class="text-gray-600">{{ __("Here's your profile information") }}</p>
                </div>
            </div>

            <!-- User Profile Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">{{ __('Personal Information') }}</h4>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Name') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Email') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            @if(Auth::user()->phone)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Phone') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->phone }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->date_of_birth)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Date of Birth') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->date_of_birth->format('F d, Y') }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->gender)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Gender') }}:</span>
                                <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', Auth::user()->gender)) }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Location Information Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">{{ __('Location Information') }}</h4>
                        @if(Auth::user()->address || Auth::user()->city || Auth::user()->state || Auth::user()->country || Auth::user()->postal_code)
                        <div class="space-y-3">
                            @if(Auth::user()->address)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Address') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->address }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->city)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('City') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->city }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->state)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('State/Province') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->state }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->country)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Country') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->country }}</p>
                            </div>
                            @endif
                            @if(Auth::user()->postal_code)
                            <div>
                                <span class="text-sm font-medium text-gray-500">{{ __('Postal Code') }}:</span>
                                <p class="text-gray-900">{{ Auth::user()->postal_code }}</p>
                            </div>
                            @endif
                        </div>
                        @else
                        <p class="text-gray-500 italic">{{ __('No location information provided yet.') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Bio Card (Full Width) -->
                @if(Auth::user()->bio)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg md:col-span-2">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">{{ __('Bio') }}</h4>
                        <p class="text-gray-900">{{ Auth::user()->bio }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Quick Actions') }}</h4>
                    <div class="flex gap-4">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Edit Profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
