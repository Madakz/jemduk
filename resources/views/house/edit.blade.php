@extends('layouts.main')

@section('header')
    @include('house.header')
@stop

@section('content')
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Edit House</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    {{Form::open(['route' => ['update_house', $houses->id], 'method' => 'PUT', 'files'=>true])}}
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-7">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Location" name="location" value="{{ $houses->location }}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="scope">Scope</label>
                                <select class="form-control" value="{{$houses->scope}}" name="scope">
                                    <option>Scope</option>
                                    <option value="Sale">Sale</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Lease">Lease</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7">
                                <label for="location">Description</label>
                                <textarea rows="4" cols="20" class="form-control" name="description" value="{{$houses->description}}">{{$houses->description}}</textarea>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="control-demo-6">Type</label>
                                <select class="form-control" value="{{$houses->type}}" name="type">
                                    <option>Type</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="detached duplex">Detached Duplex</option>
                                    <option value="semi-detached duplex">Semi-detached Duplex</option>
                                    <option value="detached bungalow">Detached Bungalow</option>
                                    <option value="semi-detached bungalow">Semi-detached Bungalow</option>
                                    <option value="penthouse">Penthouse</option>
                                </select>
                            </div>
                        </div>
                         
                         <br/>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="rooms">Rooms</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="rooms" placeholder="Number of Rooms" value="{{$houses->rooms}}">
                            </div>
                            <div class="col-md-4">
                                <label for="bathrooms">Bathrooms</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="bathrooms" placeholder="Number of Bathrooms" value="{{$houses->bathrooms}}">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">Sitting Room</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Number of Sitting Rooms" name="sitting_room" value="{{$houses->sitting_room}}">
                            </div>
                        </div>
                        
                        <br/>
                        
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="size">Size</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="size" placeholder="Size of House" value="{{$houses->size}}">
                            </div>
                            <div class="col-md-4">
                                <label for="coo_roo">COO/ROO Number</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="coo_roo" placeholder="COO/ROO Number" value="{{$houses->coo_roo}}">
                            </div>
                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="status" placeholder="Status" value="{{$houses->status}}">
                            </div>
                        </div>
                        
                        <br/>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Price of House" value="{{$houses->price}}">
                            </div>
                           
                            <!-- <div class="col-sm-4"> -->
                                <input type="hidden" class="form-control" id="exampleInputPassword1" name="property_type" value="house">
                            <!-- </div> -->
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-md" style="margin-top:25px;">Submit</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <div class="col-md-8">
                                <label for="picture">House photos (upload 3 pictures)</label>                                
                                <input type="file" class="form-control" id="exampleInputPassword1" name="picture[]" placeholder="Choose file" value="" multiple> -->
                                    <!-- <input type="file" class="form-control" id="exampleInputPassword1" name="picture" placeholder="Choose file" value=""> -->
                                                  
                            <!-- </div> -->
                            <!-- <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-md" style="margin-top:25px;">Submit</button>
                            </div> -->
                        </div>
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('layouts.sessions')
            @include('layouts.errors')
        </div>
    </div>
                    
                   
@stop