@extends('layouts.main')

@section('header')
    @include('house.header')
@stop

@section('content')
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">Client Information</h4>
                </header>
                <hr class="widget-separator">
                <div class="widget-body">
                    {{Form::open(array('route' => 'store_house', 'method' => 'POST', 'files'=>true))}}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="surname">Surname:</label>
                                <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{ old('surname')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="othername">Other Name(s):</label>
                                <input type="text" class="form-control" placeholder="Other Name(s)" name="othernames" value="{{ old('othernames')}}">
                            </div>
                        </div>
                            <div class="col-md-6">
                                <label for="surname">Amount Paid in words:</label>
                                <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{ old('surname')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="othername">Amount Paid in figure:</label>
                                <input type="text" class="form-control" placeholder="Other Name(s)" name="othernames" value="{{ old('othernames')}}">
                            </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="surname">Phone Number:</label>
                                <input type="text" class="form-control" placeholder="Surname" name="surname" value="{{ old('surname')}}">
                            </div>
                        </div>
                         
                         <br/>
                        <div class="form-group row">
                            
                        </div>
                        
                        <br/>
                        
                        <div class="form-group row">
                            
                        </div>
                        
                        <br/>

                        <div class="form-group row">
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="picture">House photos (upload 3 pictures)</label>                                
                                <input type="file" class="form-control" id="exampleInputPassword1" name="picture[]" placeholder="Choose file" value="" multiple>
                                    <!-- <input type="file" class="form-control" id="exampleInputPassword1" name="picture" placeholder="Choose file" value=""> -->
                                                  
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-md" style="margin-top:25px;">Submit</button>
                            </div>
                        </div>
                        
                        <!-- <br/><br/><br/>
                        
                        <div class="form-group">
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                            </div>
                        </div> -->
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