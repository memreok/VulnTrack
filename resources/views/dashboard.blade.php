<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kontrol Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Hoşgeldiniz, ") }} {{ Auth::user()->name }}! {{ __("Sisteme başarıyla giriş yaptınız.") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Toplam Zafiyet') }}</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalVulnerabilities }}</p>
                    </div>
                </div>

                <div class="bg-green-100 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-green-900 dark:text-green-100">{{ __('Açık Zafiyetler') }}</h3>
                        <p class="mt-1 text-3xl font-semibold text-green-700 dark:text-green-200">{{ $openVulnerabilities }}</p>
                    </div>
                </div>

                <div class="bg-red-100 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-red-900 dark:text-red-100">{{ __('Kapatılan Zafiyetler') }}</h3>
                        <p class="mt-1 text-3xl font-semibold text-red-700 dark:text-red-200">{{ $closedVulnerabilities }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Hızlı İşlemler') }}</h3>
                    <div class="flex space-x-4">
                        <a href="{{ route('vulnerabilities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 dark:hover:bg-gray-600 active:bg-gray-700 dark:active:bg-gray-500 focus:outline-none focus:border-gray-700 dark:focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-600 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Tüm Zafiyetleri Gör') }}
                        </a>
                        <a href="{{ route('vulnerabilities.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Yeni Zafiyet Ekle') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
