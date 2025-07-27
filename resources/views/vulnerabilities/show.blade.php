<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Zafiyet Detayı: ') }} {{ Str::limit($vulnerability->title, 30) }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('vulnerabilities.edit', $vulnerability) }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">
                    {{ __('Düzenle') }}
                </a>
                <a href="{{ route('vulnerabilities.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                    &larr; {{ __('Listeye Dön') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 rounded-lg shadow-md" role="alert">
                    <strong class="font-bold text-green-900 dark:text-green-50">Başarılı!</strong>
                    <span class="block sm:inline dark:text-green-100">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Başlık') }}</h3>
                        <p class="mt-1 text-md text-gray-700 dark:text-gray-300">{{ $vulnerability->title }}</p>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('Açıklama') }}</h3>
                        <div class="mt-1 text-md text-gray-700 dark:text-gray-300 whitespace-pre-wrap prose dark:prose-invert max-w-none">
                            {!! nl2br(e($vulnerability->description)) !!}
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('ID') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->id }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Önem Derecesi') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->severity }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Durum') }}</h4>
                            <p class="mt-1 text-md">
                                @if($vulnerability->status == 'Açık')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100">
                                        Açık
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100">
                                        Kapatıldı
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Ekleyen Kullanıcı') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Atanan Kişi') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->assignee->name ?? 'Atanmamış' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Oluşturulma Tarihi') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                         <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Açık Kalma Süresi (Gün)') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->days_open ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Yorum Sayısı') }}</h4>
                            <p class="mt-1 text-md text-gray-900 dark:text-gray-100">{{ $vulnerability->comment_count ?? '0' }}</p>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ __('Etiketler') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($vulnerability->tags as $tag)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                    {{ $tag->name }}
                                </span>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Bu zafiyete atanmış bir etiket bulunmamaktadır.') }}</p>
                            @endforelse
                        </div>
                    </div>

                    @if ($vulnerability->status == 'Açık')
                        <hr class="border-gray-200 dark:border-gray-700 mt-6">
                        <div class="mt-6">
                            <form method="POST" action="{{ route('vulnerabilities.update', $vulnerability) }}" class="inline-block">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Kapatıldı">
                                <input type="hidden" name="quick_status_update" value="true">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Kapatıldı Olarak İşaretle') }}
                                </button>
                            </form>
                        </div>
                    @endif

                    <hr class="border-gray-200 dark:border-gray-700 mt-6">
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ __('Yorumlar') }}</h3>


                        <form method="POST" action="{{ route('comments.store', $vulnerability) }}" class="mb-6">
                            @csrf
                            <div class="w-full">
                                <label for="body" class="sr-only">{{ __('Yorumunuz') }}</label>
                                <textarea name="body" id="body" rows="3"
                                          class="block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                          placeholder="{{ __('Bir yorum yazın...') }}" required></textarea>
                                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <x-primary-button>
                                    {{ __('Yorum Yap') }}
                                </x-primary-button>
                            </div>
                        </form>


                        <div class="space-y-4">
                            @forelse ($vulnerability->comments as $comment)
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg shadow">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="font-bold text-gray-800 dark:text-white">{{ $comment->user->name }}</div>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400" title="{{ $comment->created_at }}">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <p class="mt-2 text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                                        {{ $comment->body }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Henüz hiç yorum yapılmamış.') }}</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
