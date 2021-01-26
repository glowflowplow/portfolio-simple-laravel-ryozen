<x-app-layout>
    <x-slot name="header">
        Post
    </x-slot>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
            <form action="" method="post">
                @csrf
                <div>
                    <label for="message">message: </label>
                    <input type="text" name="message" id="message" value="{{ $message }}">
                </div>
                <button type="submit">submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
