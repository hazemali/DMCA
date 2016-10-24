@extends('layouts.app')




@section('content')

<h1 class='page-header'>Your Notices</h1>

<table class="table table-striped table-bordered">

    <thead>
        <th>This Content:</th>
        <th>Accessible Here:</th>
        <th>Is Infringing upon on my work here:</th>
        <th>Notice Sent:</th>
        <th>Content Removed</th>

    </thead>
    <tbody>
        @foreach($notices as  $notice)
        <tr>
            <td> {{$notice->infringing_title}} </td>
            <td> {{$notice->infringing_link}} </td>
            <td> {{$notice->original_link}} </td>

            <td> {{$notice->created_at->diffForHumans()}} </td>

            <td> 
                <div class="form-group">


                    <form data-remote method="post" action="{{route('notices.show',[$notice->id])}}"> 

                        {{method_field('patch')}}  

                        {{CSRF_FIELD()}}

                        <input class="checkbox" @if($notice->content_removed) checked
                        <@endif type="checkbox" name="content_removed"
                        value='1' data-click-submits-form />  


                    </form>     

                </td>
            </tr>
            @endforeach



        </tbody>

    </table>




    @unless(count($notices))

    <p class='text-center'>You haven't sent Any DMCA Notices yet, <a href='{{route('notices.create')}}'>Create your first notice.</a></p>

    @endunless



    @endsection