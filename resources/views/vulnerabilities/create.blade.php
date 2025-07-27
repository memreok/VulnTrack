<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Yeni Zafiyet Ekle') }}
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

                    <form method="POST" action="{{ route('vulnerabilities.store') }}">
                        @csrf

                        <div class="mt-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Başlık') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Açıklama') }}</label>
                            <textarea name="description" id="description" rows="5" required
                                      class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="severity" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Önem Derecesi') }}</label>
                            <select name="severity" id="severity" required
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">{{ __('-- Seçiniz --') }}</option>
                                <option value="Düşük" @if(old('severity') == 'Düşük') selected @endif>{{ __('Düşük') }}</option>
                                <option value="Orta" @if(old('severity') == 'Orta') selected @endif>{{ __('Orta') }}</option>
                                <option value="Yüksek" @if(old('severity') == 'Yüksek') selected @endif>{{ __('Yüksek') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="assignee_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Atanan Kişi (Opsiyonel)') }}</label>
                            <select name="assignee_id" id="assignee_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">-- Atanmadı / Seçiniz --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected(old('assignee_id') == $user->id)>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('assignee_id')" class="mt-2" />
                        </div>
                         <div class="mt-4">
                            <label for="tags" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Etiketler (Opsiyonel)') }}</label>
                            <select name="tags[]" id="tags" multiple
                                    class="block mt-1 w-full h-40 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                @foreach ($tags as $tag)

                                    <option value="{{ $tag->id }}" @selected(is_array(old('tags')) && in_array($tag->id, old('tags')))>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('vulnerabilities.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('İptal') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Kaydet') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
