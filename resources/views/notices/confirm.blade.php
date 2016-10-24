@extends('layouts.app')



@section('content')





<h1 class='page-heading'>Confirm a DMCA Notice</h1>

<form method="post" action='{{ url('notices') }}'>

    {{CSRF_FIELD()}}
    
    
    <div class='form-group'>

     
        
        <textarea style="height:250px;"  name='template' required="required" class="form-control">@if(old('notice')){{old('notice')}} @else {{$template}}  @endif</textarea>
       
        @if ($errors->has('template'))
        <div class="alert alert-warning">
            {{$errors->first('template')}} 
        </div>

        @endif


    </div>



    <div class='form-group'>

        <button type="submit" class="button form-control btn-primary">Send Notice</button>
    </div>

    
</form>
@endsection