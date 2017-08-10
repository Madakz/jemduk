<?php
	// dd($properties);
?>
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
    <br/>
    <section class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <header class="widget-header">
                        <h4 class="widget-title">List of {{ $properties[0]->surname}} {{ $properties[0]->othername }} Properties</h4>
                    </header>
                    <hr class="widget-separator">
                    <div class="widget-body">
                        @if(count($properties[1]) < 1)
                            <div>No Properties added yet!</div>
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
                                         @foreach($properties[1] as $property)                                                    
                                            <tr>
                                                <td>{{$sn}}</td>
                                                <td>{{$property->location}}</td>
                                                <td>{{$property->type}}</td>
                                                <td>{{$property->scope}}</td>
                                                <td>{{$property->size}}</td>
                                                <td>{{$property->status}}</td>
                                                <td>{{$property->price}}</td>
                                                @if($property->property_type == 'house')
                                                	<td>
	                                                    <a data-toggle="modal" href="{{ route('show_house', [$property->id])}}" id="edit-bu-btn" style="cursor:pointer;">
	                                                        <i class="fa fa-folder-open"></i> Show
	                                                    </a>
	                                                </td>
                                                @elseif($property->property_type == 'land')
                                                	<td>
	                                                    <a data-toggle="modal" href="{{ route('show_land', [$property->id])}}" id="edit-bu-btn" style="cursor:pointer;">
	                                                        <i class="fa fa-folder-open"></i> Show
	                                                    </a>
	                                                </td>
                                                @elseif($property->property_type == 'shop')
                                                	<td>
	                                                   <a data-toggle="modal" href="{{ route('show_shop', [$property->id])}}" id="edit-bu-btn" style="cursor:pointer;">
	                                                        <i class="fa fa-folder-open"></i> Show
	                                                    </a>
	                                                </td>
                                                @endif
                                                	
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