@extends('layouts.app')
@section('PageTitle', 'Update Students Profile')

@section('css')
<link rel="stylesheet" href="/vendor/select2/css/select2.min.css">@endsection
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('users.students.index') }}">Students</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Register new Students</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bulk Update Students Profile</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-12">

                                <form action="{{ route('users.students.bulk_update.index') }}" method="post">
                                    @csrf
                                    <div class="basic-form col-md-6 d-flex align-items-center">
                                        <div class="mb-2 mx-sm-3">
                                            <label class="sr-only">Password</label>
                                            <select class="form-control wide 4mb-3" name="class_id" required>
                                                <option value="">--Select Class--</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" {{ @$class_id == $class->id ? 'selected' : ''}}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-secondary mb-2 mx-2">Search</button>
                                    </div>
                                </form>

                                @if(isset($students))
                                <div class="mb-2 row">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-l">
                                            <thead>
                                                <tr>
                                                    <th style="width:50px;">
                                                        S/N
                                                    </th>
                                                    <th><strong>ROLL NO.</strong></th>
                                                    <th><strong>NAME</strong></th>
                                                    <th><strong>PASSPORT</strong></th>
                                                    <th><strong>DOB</strong></th>
                                                    <th><strong>PARENT</strong></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $key => $student )
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td><strong>{{ $student->login }}</strong></td>
                                                    <td><div class="d-flex align-items-center"><img src="/uploads/default.png" id="previewImg{{$key}}" class="rounded-lg me-2" width="40" alt=""/> <span class="w-space-no">{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</span></div></td>
                                                    <td><input type="file" onchange="previewFile{{$key}}(this);" name="photo{{$key}}"></td>
                                                    <td><input type="date" class="form-control"></td>
                                                    <td>
                                                        <select class="default-select form-control wide">
                                                            <option value=""></option>
                                                            @foreach ($parents as $parent)
                                                                <option value="{{ $parent->id }}">{{ $parent->title.' '.$parent->first_name.' '.$parent->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10">
                                        <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                                    </div>
                                </div> 
                                @endif
                            
                    
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/vendor/select2/js/select2.full.min.js"></script>
<script src="/js/plugins-init/select2-init.js"></script>
@include('users.students.script')

@foreach ($students as $row => $student )
<script>
    
    function previewFile{{$row}}(input){
      
        var file = $("input[name=photo{{ $row }}]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg{{ $row }}").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
@endforeach

@endsection