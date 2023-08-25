@extends('admin.layouts.master')

@section('title', 'Category-List-Page')
@section('navbar_title', 'Product List')


@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                {{-- Profile update success message --}}
                {{-- <div class="col-5 offset-7">
                        @if (session('updateProfileSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session("updateProfileSuccess") }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div> --}}

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Detail</h3>
                            </div>


                            <div class="row">
                                <div class="col-4 offset-1 ">
                                    <div class="mt-5"
                                        style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;">
                                        <img src="{{ asset('storage/' . $pizza->image) }}" />
                                    </div>
                                </div>
                                <div class="col-6 offset-1 ">
                                    <div class="my-3">
                                        <i class="fa-solid fa-pizza-slice me-2"></i>
                                        {{ $pizza->name }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-money-bill-1-wave me-2"></i>
                                        {{ $pizza->price }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-regular fa-clock me-2"></i>
                                        {{ $pizza->waiting_time }} mins
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-regular fa-eye me-2"></i>
                                        {{ $pizza->view_count }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-sitemap me-2"></i>
                                        {{ $pizza->category_id }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-file-lines me-2"></i>
                                        {{ $pizza->description }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ $pizza->created_at->format('j F Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-4">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark">
                                            <i class="fa-solid fa-user-pen me-2"></i>
                                            Edit your pizza
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
