<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Zafiyet Listesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-lg shadow-md" role="alert">
                            <strong class="font-bold text-green-900 dark:text-green-50">Başarılı!</strong>
                            <span class="block sm:inline dark:text-green-100">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">

                        <form method="GET" action="{{ route('vulnerabilities.index') }}" class="flex flex-col sm:flex-row items-end space-y-3 sm:space-y-0 sm:space-x-3 w-full sm:w-auto mb-4 sm:mb-0">

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Durum:') }}</label>
                                <select name="status" id="status"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="Tümü" @selected(isset($currentStatus) && $currentStatus == 'Tümü')>{{ __('Tümü') }}</option>
                                    <option value="Açık" @selected(isset($currentStatus) && $currentStatus == 'Açık')>{{ __('Açık') }}</option>
                                    <option value="Kapatıldı" @selected(isset($currentStatus) && $currentStatus == 'Kapatıldı')>{{ __('Kapatıldı') }}</option>
                                </select>
                            </div>

                            <div>
                                <label for="severity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Önem Derecesi:') }}</label>
                                <select name="severity" id="severity"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="Tümü" @selected(isset($currentSeverity) && $currentSeverity == 'Tümü')>{{ __('Tümü') }}</option>
                                    <option value="Düşük" @selected(isset($currentSeverity) && $currentSeverity == 'Düşük')>{{ __('Düşük') }}</option>
                                    <option value="Orta" @selected(isset($currentSeverity) && $currentSeverity == 'Orta')>{{ __('Orta') }}</option>
                                    <option value="Yüksek" @selected(isset($currentSeverity) && $currentSeverity == 'Yüksek')>{{ __('Yüksek') }}</option>
                                </select>
                            </div>

                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Ara:') }}</label>
                                <input type="text" name="search" id="search" value="{{ $currentSearch ?? '' }}" placeholder="Başlık veya açıklamada ara..."
                                       class="mt-1 block w-full sm:max-w-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                            </div>

                            <div class="self-end"> {{-- Butonu diğerleriyle aynı hizada tutmak için (label olmadığı için) --}}
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-700 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Filtrele / Ara') }}
                                </button>
                            </div>
                        </form>


                        <a href="{{ route('vulnerabilities.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Yeni Zafiyet Ekle') }}
                        </a>
                    </div>

                    @if ($vulnerabilities->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        @php
                                        $linkParams = function($column) use ($sortBy, $sortDir) {
                                            $params = request()->query();
                                            $params['sort_by'] = $column;
                                            $params['sort_dir'] = ($sortBy == $column && $sortDir == 'asc') ? 'desc' : 'asc';
                                            return $params;
                                        };
                                        @endphp
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ route('vulnerabilities.index', $linkParams('id')) }}">
                                                ID
                                                @if ($sortBy == 'id') <span class="ml-1">@if ($sortDir == 'asc') &uarr; @else &darr; @endif</span> @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ route('vulnerabilities.index', $linkParams('title')) }}">
                                                Başlık
                                                @if ($sortBy == 'title') <span class="ml-1">@if ($sortDir == 'asc') &uarr; @else &darr; @endif</span> @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ route('vulnerabilities.index', $linkParams('severity')) }}">
                                                Önem
                                                @if ($sortBy == 'severity') <span class="ml-1">@if ($sortDir == 'asc') &uarr; @else &darr; @endif</span> @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ route('vulnerabilities.index', $linkParams('status')) }}">
                                                Durum
                                                @if ($sortBy == 'status') <span class="ml-1">@if ($sortDir == 'asc') &uarr; @else &darr; @endif</span> @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Ekleyen
                                        </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Atanan Kişi
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Etiketler
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <a href="{{ route('vulnerabilities.index', $linkParams('created_at')) }}">
                                                Tarih
                                                @if ($sortBy == 'created_at') <span class="ml-1">@if ($sortDir == 'asc') &uarr; @else &darr; @endif</span> @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksiyonlar</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($vulnerabilities as $vulnerability)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $vulnerability->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ Str::limit($vulnerability->title, 30) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $vulnerability->severity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($vulnerability->status == 'Açık')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                                        Açık
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100">
                                                        Kapatıldı
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $vulnerability->user->name ?? 'N/A' }}</td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
            {{ $vulnerability->assignee->name ?? '--' }}
        </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
            <div class="flex flex-wrap gap-1">
                @foreach ($vulnerability->tags->take(2) as $tag)
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        {{ $tag->name }}
                    </span>
                @endforeach
                @if ($vulnerability->tags->count() > 2)
                    <span class="text-xs text-gray-500 dark:text-gray-400">...</span>
                @endif
            </div>
        </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $vulnerability->created_at->format('d/m/Y H:i') }}</td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('vulnerabilities.show', $vulnerability) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Detay</a>
                                                <a href="{{ route('vulnerabilities.edit', $vulnerability) }}" class="ml-3 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">Düzenle</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $vulnerabilities->links() }}
                        </div>
                    @else
                        <p class="text-center py-4">{{ __('Henüz hiç zafiyet kaydı bulunmamaktadır.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
