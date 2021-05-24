@extends('layouts.public.index')

@section('content')
    <div class="container">
        @error('notfound')
                        
            
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Error</strong> {{$message}}

                    
                </div>
            </div>
        </div>
        @enderror
        <div class="row justify-content-center">
            <div class="col-6 text-center ">
                <form action="{{route('postme')}}" class="form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="search">Put URL</label>
                        <input type="url" class="form-control" name="url" id="search" aria-describedby="helpId"
                            placeholder="">
                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
