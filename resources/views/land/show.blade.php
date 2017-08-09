@extends('layouts.main')

@section('header')
    @include('land.header')
@stop

@section('content')
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Land Details</h4>
            </header>
            <hr class="widget-separator">
            
            <div class="widget-body">
                <div class="form-group">
                    <table>
                        <tr>
                            <td>
                                <b>Images: </b>
                            </td>
                            <td>  </td>
                            <?php $countphoto= count($lands->photo); ?>
                                @if ($countphoto === 0)
                                    <td> No Images </td>
                                @else
                                    @for ($i=0; $i < $countphoto; $i++)
                                        <td style="width:260px;"><img class="img-thumbnail" src="{!! url('photo/'.$lands->photo[$i]->photo_name) !!}" style="height:250px; width:250px;"></td>
                                    @endfor
                                @endif                            
                        </tr>
                        <tr>
                            <td>
                                <b>Location: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $lands->location}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                         <tr>
                            <td>
                                <b>Scope: </b>
                            </td>
                            <td>  </td>
                            <td> {{$lands->scope}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Type: </b>
                            </td>
                            <td>  </td>
                            <td> {{$lands->type}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Size of the Land: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $lands->size}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>COO/ROO Number: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $lands->coo_roo}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Status: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $lands->status}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Description: </b>
                            </td>
                            <td>  </td>
                            <td> {{$lands->description}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Price: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $lands->price}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="widget-body">
                <div class="form-group">
                    @if($lands->status == 'vacant' && ($lands->scope == 'Rent' || $lands->scope == 'Lease'))
                        <a href="{{ route('allocate_land', [$lands->id])}}">                        
                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> Allocate Land</button>
                        </a>
                    @elseif($lands->status == 'vacant' && $lands->scope == 'Sale')
                        <a href="{{ route('sell_land', [$lands->id])}}">                        
                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> Sell Land</button>
                        </a>
                    @elseif($lands->status == 'sold' && $lands->scope == 'Sale')
                        <!-- <a href="{{ route('de_allocate_land', [$lands->id])}}">                         -->
                            <button type="submit" class="btn btn-default btn-md"><i class="menu-icon zmdi zmdi-lock zmdi-hc"></i> Sold</button>
                        <!-- </a> -->
                    @else
                        <a href="{{ route('de_allocate_land', [$lands->id])}}">                        
                            <button type="submit" class="btn btn-warning btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> De-allocate Land</button>
                        </a>
                    @endif
                    <a href="{{ route('edit_land', [$lands->id])}}">
                        <button type="submit" class="btn btn-primary btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Edit</button>
                    </a>
                    <a data-toggle="modal" data-target="#modal_delete_{{$lands->id}}" id="delete-bu-btn" style="cursor:pointer;margin-left:10px;">
                        <button type="submit" class="btn btn-danger btn-md"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</button> 
                    </a>
                    @include('land.modals.delete')
                </div>
            </div>
        </div>
    </div>
@endsection