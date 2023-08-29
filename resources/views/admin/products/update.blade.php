@extends('admin.layouts.master')

@section('title', 'Category-List-Page')
@section('navbar_title', 'Product List')


@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>


                            <form action="{{ route('products#update', $pizza->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/' . $pizza->image) }}" />

                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" style="font-size: 14px;"
                                                class="form-control mt-3 @error('pizzaImage') is-invalid @enderror ">

                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12" type="submit">
                                                Update
                                                <i class="fa-solid fa-circle-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" value="{{ old('pizzaName', $pizza->name) }}"
                                                name="pizzaName" type="text"
                                                class="form-control @error('pizzaName') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">

                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror"
                                                placeholder="Enter Description" rows="8">{{ old('pizzaDescription', $pizza->description) }}</textarea>

                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" value="{{ old('pizzaPrice', $pizza->price) }}"
                                                name="pizzaPrice" type="number"
                                                class="form-control @error('pizzaPrice') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Pizza Price...">

                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                name="pizzaWaitingTime" type="number"
                                                class="form-control @error('pizzaWaitingTime') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Waiting Time...">

                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" value="{{ old('viewCount', $pizza->view_count) }}"
                                                name="viewCount" type="number" class="form-control" disabled
                                                aria-required="true" aria-invalid="false">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" value="{{ $pizza->created_at->format('j-F-Y') }}"
                                                name="craeated_at" type="text" class="form-control" disabled
                                                aria-required="true" aria-invalid="false">
                                        </div>
                                    </div>
                                </div>




                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
