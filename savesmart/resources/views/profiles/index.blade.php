@extends('layouts.app')

@section('content')
    <h2 class="text-center text-5xl font-bold mb-3.5">Vos Profils</h2>
    <ul class="  flex items-center justify-center mx-48 flex-wrap ">
        @foreach ($profiles as $profile)
        <li class="flex items-center flex-col w-fit  p-4 rounded-lg mt-10 ">
            <a href="{{ route('home', $profile->id) }}" class="text-lg font-semibold text-black hover:underline flex items-center flex-col">
                <img src="https://picsum.photos/100/100" alt="Profile" class="w-[100px] rounded-[50%]  ">
                {{ substr($profile->name, 0, 3) }}
            </a>
        </li>
        @endforeach
        <a class = "mt-3" href="{{ route('profiles.create') }}"><i class="bi bi-plus-lg text-7xl rounded"></i></a>
    </ul>
@endsection
