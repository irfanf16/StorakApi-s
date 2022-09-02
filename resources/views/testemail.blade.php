@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h6>Hellow world</h6>
                    {{ dd($order_details) }}
                </div>
            </div>
        </div>
    </div>
@endsection
