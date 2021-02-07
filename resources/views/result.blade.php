@extends('layouts/main')
@section('content')
<style>

    #result{
        width: 30%;
        margin: 0px auto;
        margin-top: 50px;
        
    }
</style>
<div id="result" class="bg-light">
    <h3>Result</h3>
    @php
    $num_correct=count(session('answer'));
    $total=count(session('answer')[0]->question->quizz->questions);
    @endphp
    <p>{{$num_correct}}/{{$total}}</p>
</div>
@endsection