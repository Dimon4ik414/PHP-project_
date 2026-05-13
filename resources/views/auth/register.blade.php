
@extends('layouts.app')
@section('content')
<style>
    form{
        display: flex;
        align-content: center;
        flex-direction: initial;
        padding-right: 10px ;
        border:fuchsia 2px ;
        box-shadow: 3px 3px 6px darkviolet;


    }

</style>
    <div class="card-body">
        <from method="category" action="{{route('register.category')}}">
            @csrf

            <div class="mb-3">
                <label>Имя:
                    <input type="text" name="name" class="from-control" value="{{old('name')}}">
                </label>
            </div>
        </from>
    </div>

<div class="mb-3">
    <label>Email:
        <input type="text" email="email" class="from-control" value="{{('email')}}">
    </label>

    </label>

</div>
    <div class="mb-3">
        <label>Password:
            <input type="password" password="password" class="from-control" value="{{old('password')}}">
        </label>

        </label>

    </div>
