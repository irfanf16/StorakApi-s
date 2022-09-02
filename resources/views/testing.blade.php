@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                <div class="order-icon">
                                    <i class="fas fa-border-all"></i>
                                </div>
                            </td>
                            <td>
                                {{ $notification->message }}
                            </td>

                            <td>
                                {{ date('d-M-y : H:i', strtotime($notification->created_at)) }}
                            </td>
                            <td>
                                {{ date('d-M-y : H:i', strtotime($notification->updated_at)) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ $notification->link }}" class="btn btn-primary btn-icon-only custom-order-veiw">
                                    <span class=""><i class=" fa fa-eye"></i></span>
                                </a>
                            </td>

                        </tr>
                    @endforeach

                    {!! $notifications->links() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
