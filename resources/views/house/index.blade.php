@extends('layouts.main')

@section('header')
    @include('house.header')
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/lightbox2/dist/css/lightbox.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('create_house')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="fa fa-plus"></i>
                    <span>    Add House</span>
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
                        <h4 class="widget-title">List of Houses</h4>
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
                        @if(count($houses) < 1)
                            <div>No Houses added yet!</div>
                        @else
                            <div class="table-responsive">
                                <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S/no</th>
                                            <th>Location</th>
                                            <th>Scope</th>
                                            <th>Type</th>
                                            <th>Rooms</th>
                                            <th>Bathrooms</th>
                                            <th>Sitting Room</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/no</th>
                                            <th>Location</th>
                                            <th>Scope</th>
                                            <th>Type</th>
                                            <th>Rooms</th>
                                            <th>Bathrooms</th>
                                            <th>Sitting Room</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php
                                        $sn=1;
                                    ?>
                                    @foreach($houses as $house)
                                        <tbody>
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$house->location}}</td>
                                                <td>{{$house->scope}}</td>
                                                <td>{{$house->type}}</td>
                                                <td>{{$house->rooms}}</td>
                                                <td>{{$house->bathrooms}}</td>
                                                <td>{{$house->sitting_room}}</td>
                                                <td>{{$house->size}}</td>
                                                <td>{{$house->status}}</td>
                                                <td>
                                                    <a data-toggle="modal" href="houses/show/{{$house->id}}" id="edit-bu-btn" style="cursor:pointer;">
                                                        <i class="fa fa-folder-open"></i> Show
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php
                                        $sn++;
                                    ?>
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