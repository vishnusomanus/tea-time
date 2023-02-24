@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <a href="{{URL::to('/')}}" class="btn btn-primary mb-3">Today's Menu</a>
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
        
    <div>
        <label for="Kudi">Kudi:</label>
        @foreach($menuKudi as $menuItem)
            <div>
                <input type="radio" id="Kudi_{{ $menuItem['id'] }}" name="Kudi" value="{{$menuItem['id']}}"
                @if (in_array($menuItem["id"], $menuToday))
                    checked
                @endif
                >
                <label for="Kudi_{{ $menuItem['id'] }}">{{ $menuItem['name'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="Kadi">Kadi:</label>
        @foreach($menuKadi as $menuItem)
            <div>
                <input type="radio" id="Kadi_{{ $menuItem['id'] }}" name="Kadi" value="{{$menuItem['id']}}"
                @if (in_array($menuItem["id"], $menuToday))
                    checked
                @endif
                >
                <label for="Kadi_{{ $menuItem['id'] }}">{{ $menuItem['name'] }}</label>
            </div>
        @endforeach
    </div>
    
    <div>
    <button type="submit" class="btn btn-primary">{{ $edit ? 'Update' : 'Save' }}</button>
    </div>
</form>

        @endauth
    </div>
@endsection
