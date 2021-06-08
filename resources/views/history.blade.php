@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #393300;
        }

        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 50px;
            }
        }

    </style>



    <div class="container">
        {{-- content ด้านล่าง --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-secondary text-white" style="background-color: #91810B">
                    <div class="card-header d-flex justify-content-between">{{ __('ประวัติการสุ่ม') }}
                        <a href="{{ route('home') }}" class="btn btn-warning">กลับ</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- <div id="timer"></div>
                        <input type="button" id="startx" value="start" /> --}}

                        <table class="table table-hover table-bordered table-striped table-dark" id="table_random">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อ-สกุล</th>
                                    <th scope="col">ชื่อผู้ใช้</th>
                                    <th scope="col">เบอร์โทร</th>
                                    <th scope="col">บันทึกเมื่อ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($random_details as $random)
                                    <tr id="{{ $random->cus_id }}">
                                        <td class="align-middle">{{ $random->cus_name }}</td>
                                        <td class="align-middle">{{ $random->cus_username }}</td>
                                        <td class="align-middle">{{ $random->tel }}</td>
                                        <td class="align-middle">
                                            {{ Carbon\Carbon::parse($random->created_at)->locale('th')->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $random_details->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
