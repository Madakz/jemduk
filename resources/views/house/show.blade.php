@extends('layouts.main')

@section('header')
    @include('house.header')
@stop

@section('content')
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">House Details</h4>
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
                            <?php $countphoto= count($houses->photo);?>
                            <!-- dd($countphoto); -->
                            @if ($countphoto === 0) {
                                <td> No Images </td>
                            @else
                                @for ($i=0; $i < $countphoto; $i++)
                                    <td style="width:260px;"><img class="img-thumbnail" src="{!! url('photo/'.$houses->photo[$i]->photo_name) !!}" style="height:250px; width:250px;"></td>
                                @endfor
                            @endif
                        </tr>
                        <tr>
                            <td>
                                <b>Location: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->location}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Scope: </b>
                            </td>
                            <td>  </td>
                            <td> {{$houses->scope}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Type: </b>
                            </td>
                            <td>  </td>
                            <td> {{$houses->type}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Number of Rooms: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->rooms}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Number of Bathrooms: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->bathrooms}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Number of Sitting Rooms: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->sitting_room}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Size of the building: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->size}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Price: </b>
                            </td>
                            <td>  </td>
                            <td> {{$houses->price}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>COO/ROO Number: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->coo_roo}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Status: </b>
                            </td>
                            <td>  </td>
                            <td> {{ $houses->status}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                        <tr>
                            <td>
                                <b>Description: </b>
                            </td>
                            <td>  </td>
                            <td> {{$houses->description}}</td>
                        </tr>
                        <tr style="border-top: 20px solid transparent;"></tr>
                    </table>
                </div>
            </div>
            
            <div class="widget-body">
                <div class="form-group">
                    @if($houses->status == 'vacant' && ($houses->scope == 'Rent' || $houses->scope == 'Lease'))
                        <a href="{{ route('allocate_house', [$houses->id])}}">                        
                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> Allocate house</button>
                        </a>
                    @elseif($houses->status == 'vacant' && $houses->scope == 'Sale')
                        <a href="{{ route('sell_house', [$houses->id])}}">                        
                            <button type="submit" class="btn btn-success btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> Sell house</button>
                        </a>
                    @else
                        <a href="{{ route('de_allocate_house', [$houses->id])}}">                        
                            <button type="submit" class="btn btn-warning btn-md"><i class="menu-icon zmdi zmdi-label zmdi-hc"></i> De-allocate house</button>
                        </a>
                    @endif
                    <a href="{{ route('edit_house', [$houses->id])}}">                        
                        <button type="submit" class="btn btn-primary btn-md"><i class="menu-icon zmdi zmdi-edit zmdi-hc"></i> Edit</button>
                    </a>
                    <a data-toggle="modal" data-target="#modal_delete_{{$houses->id}}" id="delete-bu-btn" style="cursor:pointer;margin-left:10px;">
                        <button type="submit" class="btn btn-danger btn-md"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</button> 
                    </a>
                    @include('house.modals.delete')
                </div>
            </div>
        </div>
    </div>
@endsection