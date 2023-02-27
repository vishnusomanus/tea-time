@extends('layouts.app-master')

@section('content')
    <div class="pt-5 pb-5 rounded">
        @auth
        <div class="text-center">
            <a href="{{URL::to('/mymenu')}}" class="btn btn-primary mb-3">Create My Menu</a>
        </div>
        <div class="card-wrapper">
            <h2>Today's Menu</h2>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menuTodayTotals as $item)
                    <tr>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['total']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-wrapper">
            <h2>Kadi</h2>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Item</th>
                    <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menuTodayKadi as $item)
                    <tr>
                    <td>{{$item['item']}}</td>
                    <td>{{$item['name']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h2>Kudi</h2>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Item</th>
                    <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menuTodayKudi as $item)
                    <tr>
                    <td>{{$item['item']}}</td>
                    <td>{{$item['name']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
