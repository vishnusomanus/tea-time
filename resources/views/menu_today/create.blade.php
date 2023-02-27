@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <div class="text-center">
            <a href="{{URL::to('/')}}" class="btn btn-primary mb-3">Today's Menu</a>
        </div>
        @if ($edit)
            <form action="{{ route('mymenu.update') }}" method="POST">
            @method('PUT')
            @foreach($menuTodayId as $idList)
            <input type="hidden" name="id[]" value="{{$idList}}">
            @endforeach
        @else
            <form action="{{ route('mymenu.post') }}" method="POST">

        @endif
        @csrf
        
        <h2 class="text-center">Kudi</h2>
    <div class="kadi_kudi">
        @foreach($menuKudi as $menuItem)
            <div class="items_each">
            
                <input type="radio" id="Kudi_{{ $menuItem['id'] }}" name="Kudi" value="{{$menuItem['id']}}"
                @if (in_array($menuItem["id"], $menuToday))
                    checked
                @endif
                >
                <label for="Kudi_{{ $menuItem['id'] }}">
                    <img class="item_image" src="{{$menuItem['image']}}" / >
                    <div class="item_name">{{ $menuItem['name'] }}</div>
                </label>
            </div>
        @endforeach
    </div>
    <h2 class="text-center m-3">Kadi</h2>
    <div class="kadi_kudi">
        @foreach($menuKadi as $menuItem)
            <div class="items_each">
            
                <input type="radio" id="Kadi_{{ $menuItem['id'] }}" name="Kadi" value="{{$menuItem['id']}}"
                @if (in_array($menuItem["id"], $menuToday))
                    checked
                @endif
                >
                <label for="Kadi_{{ $menuItem['id'] }}">
                    <img class="item_image" src="{{$menuItem['image']}}" / >
                    <div class="item_name">{{ $menuItem['name'] }}</div>
                </label>
            </div>
        @endforeach
    </div>
    <div class="text-center">
            <button type="submit" class="btn btn-primary mb-3">{{ $edit ? 'Update' : 'Save' }}</button>
        </div>
</form>

        @endauth
    </div>
@endsection
