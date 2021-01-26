<x-app-layout>
    <x-slot name="header">
        Post
    </x-slot>
    <div class="flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-3/4 mt-12">
            <div class="justify-start">
                <a href="#"
                    class="mb-4 flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50 w-40">
                    CREATE POST
                </a>
            </div>
            <div class="flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Message
                                        </th>
                                        <th scope="col" class="relative py-3 w-16">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                        <th scope="col" class="relative py-3 w-16">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $post->message }}
                                        </td>
                                        <td class="py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="/posts/{{$post->id}}/edit"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
                                        </td>
                                        <td class="py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <form action="/posts/{{ $post->id }}/delete" method="post">
                                                @csrf
                                                <a href="{{ url('/posts') }}"
                                                    class="text-indigo-600 hover:text-indigo-900" onclick="
                                                    event.preventDefault();
                                                    this.closest('form').submit();">
                                                    Delete
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>