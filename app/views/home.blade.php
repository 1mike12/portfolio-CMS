@extends("layouts.default")

@section("content")
<div id="welcome">
    <div class="title">
       <h1>
           Hi, I'm Mike!
           <div class="gradientLine"></div>
       </h1> 
    </div>
    <h2>I'm an avid student of web programming. I bring together design and development, with a helping of the unconventional thrown in.</h2>
    <h4>>> <a href="{{URL::to("project-list")}}">continue to projects</a> <span class="blinking"></span></h4>
</div>
@stop

