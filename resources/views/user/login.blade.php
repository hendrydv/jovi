@extends('layout')

@section('content')

    <div class="mt-4">
        hoi

    </div>

    <form method="post">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>

@stop
