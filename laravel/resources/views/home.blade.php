<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            HOME
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <a href="{{ url('/posts') }}">
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 hover:bg-gray-300">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Post</div>
                    </div>
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            PostはスタンダードなCRUD機能です。メッセージを作成、表示、更新、削除ができます。
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="absolute bottom-0 right-0 mb-2 mr-4">
            <a href="https://github.com/glowflowplow/portfolio-simple-laravel-ryozen">view source</a>
        </div>
    </div>
</x-app-layout>
