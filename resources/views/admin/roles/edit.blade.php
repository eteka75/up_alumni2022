@extends('layouts.backend')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Role</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($role, [
                            'method' => 'PATCH',
                            'url' => ['/admin/roles', $role->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        @include ('admin.roles.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
