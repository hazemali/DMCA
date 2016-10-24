@extends('layouts.app')




@section('content')


<h1 class='page-heading'>Prepare a DMCA Notice</h1>

<form method="get" action='{{ url('notices','create/confirm') }}'>

    {{ CSRF_FIELD() }}

    <div class='form-group '>

        <label for='provider_id'>
            What is The Provide ?

        </label>
        

        <select  id='provider_id' name='provider_id' class="form-control">
            <option></option>
            @foreach($providers as $id => $name)
            <option value='{{$id}}'@if(old('provider_id') == $id)selected="selected"@endif> {{$name}} </option>
            @endforeach
        </select>


        @if ($errors->has('provider_id'))
        <div class="alert alert-warning">
            {{$errors->first('provider_id')}} 
        </div>
        @endif

    </div>




    <div class='form-group'>

        <label for='infringing_title'>
            Infringing title

        </label>
        <input required="required" value="{{old('infringing_title')}}" class="form-control" type="text" name="infringing_title" id='infringing_title' />


        @if ($errors->has('infringing_title'))
        <div class="alert alert-warning">
            {{$errors->first('infringing_title')}} 
        </div>

        @endif


    </div>

    <div class='form-group'>

        <label for='infringing_link'>
            Infringing link

        </label>
        <input required="required"  value="{{old('infringing_link')}}"  class="form-control" type="text" name="infringing_link" id='infringing_link' />

        
        @if ($errors->has('infringing_link'))
        <div class="alert alert-warning">
            {{$errors->first('infringing_link')}} 
        </div>

        @endif

        
    </div>
    
    
    <div class='form-group'>

        <label for='original_link'>
            original link

        </label>
        <input required="required"  value="{{old('original_link')}}"   class="form-control" type="text" name="original_link" id='original_link' />

        @if ($errors->has('original_link'))
        <div class="alert alert-warning">
            {{$errors->first('original_link')}} 
        </div>

        @endif

    </div>

    <div class='form-group'>

        <label for='description'>
            original description


        </label>
        <input  class="form-control" value="{{old('original_description')}}"  type="text" name="original_description" id='original_description' />


    </div>


    <div class='form-group'>

        <button type="submit" class="button form-control btn-primary">Preview Notice</button>
    </div>


</form>



@endsection