@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>

                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'edit')
                                <form method="POST" action="{{ url('request/edit/'. $ticket->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('request/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{$id}}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.textarea', ['name' => 'request_detail', 'label' => 'Detay', 'richText' => true])@endcomponent
                                                </div>
                                            </div>
                                            <div class="text-right" style="margin-top: 1rem">
                                                <button class="btn btn-success">Talepte Bulun</button>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
