@extends('admin.layouts.master')

@section('title', 'Product_List_Page')
@section('navbar_title', 'Product List')

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
                                <h2 class="title-1">Product Lists</h2>
                            </div> --}}
                        </div>
                        <div class="table-data__tool-right d-flex justify-between mb-3">

                            {{-- Search --}}
                            <div class="mr-5">
                                <form class="form-header" action="{{ route('products#lists') }}" method="get">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="key"
                                        placeholder="Search...." value="{{ request('key') }}" />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>


                            <div class="d-flex" style="margin-left: 200px">
                                <div class="me-2">
                                    <a href="{{ route('products#createPage') }}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add pizza
                                        </button>
                                    </a>
                                </div>



                                <div class="">
                                    <a href="#">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            CSV download
                                        </button>
                                    </a>
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
                            <h4 class=""><i class="fa-solid fa-pizza-slice"></i> Total <span> ({{ $pizzas->total() }})
                                </span> </h4>
                        </div>
                    </div>

                    {{-- Product Create message --}}
                    <div class="col-4 offset-8">
                        @if (session('productCreate'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session('productCreate') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Product Delete message --}}
                    <div class="col-4 offset-8">
                        @if (session('productDelete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session('productDelete') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    {{-- Product Update message --}}
                    <div class="col-4 offset-8">
                        @if (session('productsUpdate'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i>
                                {{ session('productsUpdate') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>price</th>
                                        <th>category</th>
                                        <th>view count</th>
                                        <th></th>
                                    </tr>
                                    <tr class="spacer"></tr>

                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{ asset('storage/' . $p->image) }}"></td>
                                            <td class="col-3"> {{ $p->name }} </td>
                                            <td class="col-2"> {{ $p->price }} </td>
                                            <td class="col-2"> {{ $p->category_id }} </td>
                                            <td class="col-2"><i class="fa-solid fa-eye"></i> {{ $p->view_count }} </td>
                                            <td class="col-1">
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                                <i class="zmdi zmdi-mail-send"></i>
                                                            </button> --}}
                                                    <a href="{{ route('products#updatePage', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#delete', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#edit', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $pizzas->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>

                        </div>
                    @else
                        <h3 class="text-muted text-center mt-5">ဘာာလာရှာပါသလဲ ..ဘာမှမရှိလို့စိတ်မကောင်းပါ😊</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
