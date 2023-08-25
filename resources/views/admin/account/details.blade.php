@extends('admin.layouts.master')

@section('title', 'Category-List-Page')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                    {{-- Profile update success message --}}
                    <div class="col-5 offset-7">
                        @if (session ("updateProfileSuccess"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session("updateProfileSuccess") }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_profile.avif') }}"  alt="profile">
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <div class="my-3">
                                        <i class="fa-solid fa-file-signature me-2"></i>
                                        {{ Auth::user()->name }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-envelope-open-text me-2"></i>
                                        {{ Auth::user()->email }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-phone me-2"></i>
                                        {{ Auth::user()->phone }}
                                    </div>

                                    <div class="my-3">
                                        @if (Auth::user()->gender == 'male')
                                            <i class="fa-solid fa-person me-2"></i>
                                        @else
                                            <i class="fa-solid fa-person-dress me-2"></i>
                                        @endif
                                        {{ Auth::user()->gender }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-location-dot me-2"></i>
                                        {{ Auth::user()->address }}
                                    </div>

                                    <div class="my-3">
                                        <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j F Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-2">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark mt-3">
                                            <i class="fa-solid fa-user-pen me-2"></i>
                                            Edit your profile
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
