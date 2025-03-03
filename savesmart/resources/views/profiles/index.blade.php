@extends('layouts.app')

@section('content')
    <h2 class="text-center text-5xl font-bold mb-3.5">Vos Profils</h2>
    <ul class="  flex items-center justify-center mx-48 flex-wrap ">
        @foreach ($profiles as $profile)
        <li class="flex items-center flex-col w-fit  p-4 rounded-lg mt-10 relative">
            <a href="{{ route('home', $profile->id) }}" class="text-lg font-semibold text-black hover:underline flex items-center flex-col">
                <img src="https://picsum.photos/100/100" alt="Profile" class="w-[100px] rounded-[50%] border-4 border-gray-500  ">
                {{ substr($profile->name, 0, 6) }}
            </a>
            <a href="{{ route('profiles.edit', $profile->id) }}" class="absolute left-24 text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="absolute left-7 text-red-800">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-transparent border-none text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </form>
        </li>
        @endforeach
        <a class = "mt-3" href="{{ route('profiles.create') }}"><i class="bi bi-plus-lg text-7xl rounded-[50%] px-3 border-4 border-gray-500"></i></a>
    </ul>
@endsection
