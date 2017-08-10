@extends('layouts.main')

@section('header')
    @include('shop.header')
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/misc/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/infinity/assets/libs/bower/lightbox2/dist/css/lightbox.min.css">
@stop

<!-- <link rel="stylesheet" type="text/css" href="{{{asset('/clientviews/css/bootstrap.min.css')}}}"> -->
    <link rel="stylesheet" type="text/css" href="{{{asset('/clientviews/css/dataTables.bootstrap.min.css')}}}">
    <link rel="stylesheet" type="text/css" href="{{{asset('/clientviews/css/jquery.dataTables.min.css')}}}">
    <link rel="stylesheet" type="text/css" href="{{{asset('/clientviews/css/jquery.dataTables_themeroller.css')}}}">
    <script type="text/javascript" src="{{{asset('/clientviews/js/jquery.js')}}}"></script>
    <script type="text/javascript" src="{{{asset('/clientviews/js/jquery.dataTables.min.js')}}}"></script>
    <script type="text/javascript" src="{{{asset('/clientviews/js/dataTables.foundation.min.js')}}}"></script> <!-- works -->

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('create_shop')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="fa fa-plus"></i>
                    <span>    Add Shop</span>
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
                        <h4 class="widget-title">List of shops</h4>
                    </header>
                    <hr class="widget-separator">
                        @if(Session::has('success'))
                            <script>
                                window.onload = function() {
                                    if(!window.location.hash) {
                                        window.location = window.location + '#loaded';
                                        window.location.reload();
                                    }
                                }
                            </script>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success')}}
                            </div>
                        @endif
                    <div class="widget-body">
                        @if(count($shops) < 1)
                            <div>No shops added yet!</div>
                        @else
                            <div class="table-responsive">
                                <table id="myTable" class="table">
                                    <thead>
                                        <?php
                                            $sn=1;
                                        ?>
                                        <th>S/no</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Scope</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/no</th>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Scope</th>
                                            <th>Size</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($shops as $shop)                                                    
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$shop->location}}</td>
                                                <td>{{$shop->type}}</td>
                                                <td>{{$shop->scope}}</td>
                                                <td>{{$shop->size}}</td>
                                                <td>{{$shop->status}}</td>
                                                <td>{{$shop->price}}</td>                                                        
                                                <td>
                                                   <a data-toggle="modal" href="shops/show/{{$shop->id}}" id="edit-bu-btn" style="cursor:pointer;">
                                                        <i class="fa fa-folder-open"></i> Show
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                                $sn++;
                                            ?>
                                            
                                        @endforeach
                                    </tbody>
                                </table>

                                <script type="text/javascript">
                                    $('#myTable').DataTable();
                                    
                                </script>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop