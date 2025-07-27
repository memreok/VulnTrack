<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Zafiyeti Düzenle: ') }} {{ $vulnerability->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 border border-red-400 dark:border-red-700 rounded-lg shadow-md" role="alert">
                            <div class="flex items-center mb-1">
                                <strong class="font-semibold text-red-800 dark:text-red-100">{{ __('Hata! Lütfen aşağıdaki sorunları düzeltin:') }}</strong>
                            </div>
                            <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-200">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('vulnerabilities.update', $vulnerability) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Başlık') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $vulnerability->title) }}" required autofocus
                                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Açıklama') }}</label>
                            <textarea name="description" id="description" rows="5" required
                                      class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description', $vulnerability->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="severity" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Önem Derecesi') }}</label>
                            <select name="severity" id="severity" required
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="Düşük" @selected(old('severity', $vulnerability->severity) == 'Düşük')>{{ __('Düşük') }}</option>
                                <option value="Orta" @selected(old('severity', $vulnerability->severity) == 'Orta')>{{ __('Orta') }}</option>
                                <option value="Yüksek" @selected(old('severity', $vulnerability->severity) == 'Yüksek')>{{ __('Yüksek') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Durum') }}</label>
                            <select name="status" id="status" required
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="Açık" @selected(old('status', $vulnerability->status) == 'Açık')>{{ __('Açık') }}</option>
                                <option value="Kapatıldı" @selected(old('status', $vulnerability->status) == 'Kapatıldı')>{{ __('Kapatıldı') }}</option>
                            </select>
                        </div>

                         <div class="mt-4">
                            <label for="assignee_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Atanan Kişi (Opsiyonel)') }}</label>
                            <select name="assignee_id" id="assignee_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">-- Atanmadı / Seçiniz --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected(old('assignee_id', $vulnerability->assignee_id) == $user->id)>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('assignee_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('vulnerabilities.show', $vulnerability) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('İptal') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Güncelle') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
