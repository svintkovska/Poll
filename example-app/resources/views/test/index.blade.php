@extends('layouts.myapp')

@section('page_title', 'Test page')

@section('content')

<div class='container'>
    <div class='row'>
    <div class="col-md-12">
        <h1>{{$message}}</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi sapiente nulla quasi. Consequuntur culpa voluptas at magni dolorem explicabo repellat facilis architecto aliquid praesentium quidem sapiente, quo sequi iusto debitis?</p>
    </div>
    <button id="swal">Swal button</button>
</div>
</div>
 @endsection




@push('scripts')
<script>
    document.getElementById('swal').addEventListener('click', function () {
        Swal.fire({
            title: "Good job",
            text: "Click",
            icon: "success"
        });
    });
</script>

@endpush



@push('styles')
<style>
    h1 {
        color: red;
    }
</style>
@endpush