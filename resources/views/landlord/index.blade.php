@extends('layouts.main')

@section('header')
    @include('landlord.header')
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
            <a href="{{route('create_landlord')}}">
                <button type="button" class="btn btn-primary" >
                    <i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i>
                    <span>    Add landlord</span>
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
                        <h4 class="widget-title">List of Landlord</h4>
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
                        @if(count($landlords) < 1)
                            <div>No Landlord added yet!</div>
                        @else
                            <div class="table-responsive">
                                <table id="myTable" class="table">
                                    <thead>
                                        <?php
                                            $sn=1;
                                        ?>
                                        <th>S/no</th>
                                        <th>Email</th>
                                        <th>Surname</th>
                                        <th>Other Name</th>
                                        <th>Gender</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/no</th>
                                            <th>Email</th>
                                            <th>Surname</th>
                                            <th>Other Name</th>
                                            <th>Gender</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         @foreach($landlords as $landlord)                                                    
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$landlord->email}}</td>
                                                <td>{{$landlord->surname}}</td>
                                                <td>{{$landlord->othername}}</td>
                                                <td>{{$landlord->gender}}</td>
                                                <td>{{$landlord->phone_number}}</td>
                                                <td>{{$landlord->address}}</td>
                                                <td>
                                                    <a data-toggle="modal" href="landlords/show/{{$landlord->id}}" id="edit-bu-btn" style="cursor:pointer;">
                                                        <i class="fa fa-folder-open"></i> View
                                                    </a>&nbsp;                                                    
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