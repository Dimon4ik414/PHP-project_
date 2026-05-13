
@extends('layouts.app')
@section('content')
<style>
    .login-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
        padding: 30px 20px;
        border: 1px dotted violet;
        box-shadow: 3px 3px 6px darkviolet;
    }

    .login-box from{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
        padding: 30px 20px;
        border: 1px dotted violet;
        box-shadow: 3px 3px 6px darkviolet;
    }
    .login-box from input{
        width: 65%;
    }

    </style>
    <div class="card-body">
        <from method="category" action="{{route('login.category')}}">
            @csrf

            <div class="mb-3">
                <label>Имя:
                    <input type="text" name="name" class="from-control" value="{{old('name')}}">
                </label>
            </div>
        </from>
    </div>

    <div class="mb-3">
        <from>
            <label>Email:
                <input type="text" email="email" class="from-control" value="{{old('email')}}">
            </label>
        </from>
    </div>




@endsection
