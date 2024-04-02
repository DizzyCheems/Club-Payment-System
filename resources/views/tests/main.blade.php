@extends('layouts.main')

@section('header')
    <div class="content-header-dark bg-img col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title white">Page Title</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Parent Section</a>
                            </li>
                            <li class="breadcrumb-item active">Current Page
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-3 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-primary round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"> Action 1</a>                                                
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"> Action 2</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    Page Content Goes Here

@endsection