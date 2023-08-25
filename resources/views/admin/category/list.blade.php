@extends('admin.layouts.master')

@section('title', 'Category-List-Page')
@section('navbar_title', 'Category List')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            {{-- <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>
                            </div> --}}
                        </div>
                        <div class="table-data__tool-right d-flex justify-between mb-3">

                            {{-- Search --}}
                            <div class="mr-5">
                                <form class="form-header" action="{{ route('category#list') }}" method="get">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="key" placeholder="Search...." value="{{ request('key') }}" />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>


                            <div class="d-flex" style="margin-left: 200px">
                                <div class="me-2">
                                    <a href="{{ route('category#createPage') }}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add item
                                        </button>
                                    </a>
                                </div>

                                <div class="">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        CSV download
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Search --}}
                    {{-- <div class="row mb-3 ">
                        <form class="form-header" action="{{ route('category#list') }}" method="get">
                            @csrf
                            <input class="au-input au-input--xl" type="text" name="key" placeholder="Search...." value="{{ request('key') }}" />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div> --}}

                    {{-- Total --}}
                    <div class="row mb-3">
                        <div class="col-2 py-2 rounded text-center">
                            <h4 class=""><i class="fa-solid fa-globe"></i> Total <span>  ({{ $categories->total() }})  </span> </h4>
                        </div>
                    </div>

                    {{-- Create Success message --}}
                    <div class="col-4 offset-8">
                        @if (session("create"))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session("create") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Delete Success message --}}
                    <div class="col-4 offset-8">
                        @if (session("info"))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-trash-can"></i>
                                {{ session("info") }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Update Success Message --}}
                    <div class="col-4 offset-8">
                        @if (session ("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session("success") }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Password Change message --}}
                    <div class="col-4 offset-8">
                        @if (session ("changePasswordSuccess"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session("changePasswordSuccess") }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>


                    @if (count($categories)!= 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>category_name</th>
                                        <th>category_date</th>
                                        <th></th>
                                    </tr>
                                        <tr class="spacer"></tr>

                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td> {{ $category->id }} </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button> --}}
                                                    <a href="{{ route('category#edit', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $categories->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>

                        </div>

                        @else
                        <h3 class="text-muted text-center mt-5">ဘာာလာရှာပါသလဲ.. ဘာမှမရှိလို့စိတ်မကောင်းပါ😊</h3>

                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
