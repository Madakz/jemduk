@extends('layouts.main')

@section('header')
    @include('land.header')
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/lightbox2/dist/css/lightbox.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('create_land')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="fa fa-plus"></i>
                    <span>    Add Land</span>
                </button>
            </a>
        </div>
    </div>
    <br/>
    <section class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title">List of Lands</h4>
                    </header>
                    <hr class="widget-separator">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success')}}
                            </div>
                        @endif
                    <div class="widget-body">
                        @if(count($lands) < 1)
                            <div>No Lands added yet!</div>
                        @else
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Scope</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Scope</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    @foreach($lands as $land)
                                        <tbody>
                                            <tr>
                                                <td>{{$land->location}}</td>
                                                <td>{{$land->type}}</td>
                                                <td>{{$land->scope}}</td>
                                                <td>{{$land->size}}</td>
                                                <td>{{$land->status}}</td>
                                                <td>{{$land->price}}</td>
                                                <td>
                                                    <a data-toggle="modal" href="lands/show/{{$land->id}}" id="edit-bu-btn" style="cursor:pointer;">
                                                        <i class="fa fa-folder-open"></i> Show
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

<script>
    window.onload = function() {
        if(!window.location.hash) {
            window.location = window.location + '#loaded';
            window.location.reload();
        }
    }
</script>