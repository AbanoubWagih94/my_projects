@extends('front.layouts.master')

@section('content')
    <h2 class="	"><i class="fa fa-shopping-cart"></i> Shopping Cart</h2>
    <hr>

    @if(Cart::instance('default')->count() > 0)
        <h4 class="mt-5">{{Cart::instance('default')->count()}} item(s) in Shopping Cart</h4>

    <div class="cart-items">

        <div class="row">

            <div class="col-md-12">

                @if(session()->has('msg'))
                    <div class="alert alert-success">{{ session()->get('msg') }}</div>
                @endif

                    @if(session()->has('err'))
                        <div class="alert alert-warning">{{ session()->get('err') }}</div>
                    @endif

                    <table class="table">
                    <tbody>
                    @foreach(Cart::instance('default')->content() as $item)
                        <tr>
                        <td><img src="{{ url('/uploads').'/'. $item->model->image_url}}" style="width: 5em"></td>
                        <td>
                            <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                        </td>

                        <td>
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                                <button type="submit" class="btn btn-link btn-link-dark btn-sm">Remove</button>
                            </form>
                            <form action="{{ route('cart.saveLater', $item->rowId) }}" method="post">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-link btn-link-dark btn-sm">Save for later</button>
                            </form>
                        </td>

                        <td>
                            <select name="" id="" class="form-control quantity" style="width: 4.7em" data-id="{{ $item->rowId }}">
                                <option {{ $item->qty == 1? 'selected': ''}}>1</option>
                                <option {{ $item->qty == 2? 'selected': ''}}>2</option>
                                <option {{ $item->qty == 3? 'selected': ''}}>3</option>
                                <option {{ $item->qty == 4? 'selected': ''}}>4</option>
                                <option {{ $item->qty == 5? 'selected': ''}}>5</option>
                            </select>
                        </td>
                        <td>${{ $item->total() }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- Price Details -->
            <div class="col-md-6">
                <div class="sub-total">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th colspan="2">Price Details</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>Subtotal </td>
                            <td>${{ Cart::subtotal() }} </td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>${{ Cart::tax() }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>{{ Cart::total() }}</th>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Save for later  -->

            <div class="col-md-12">
                <a href="{{ url('/') }}" class="btn btn-outline-dark">Continue Shopping</a>
                <a href="{{ url('/checkout') }}" class="btn btn-outline-info">Proceed to checkout</a>
                <hr>

            </div>
            @else
                <h3>There is no item in your Cart</h3>
                <a href="/" class="btn btn-outline-dark">Continue Shopping</a>
                <hr>
            @endif

            @if(Cart::instance('saveForLater')->count() > 0)
                <div class="col-md-12">

                    <h4>{{Cart::instance('saveForLater')->count()}} item(s) Save for Later</h4>
                    <table class="table">
                        <tbody>
                        @foreach(Cart::instance('saveForLater')->content() as $item)
                            <tr>
                                <td><img src="{{ url('/uploads').'/'. $item->model->image_url}}" style="width: 5em"></td>
                                <td>
                                    <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                                </td>

                                <td>
                                    <form action="{{ route('saveLater.destroy', $item->rowId) }}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <button type="submit" class="btn btn-link btn-link-dark btn-sm">Remove</button>
                                    </form>
                                    <form action="{{ route('moveToCart', $item->rowId) }}" method="post">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-link btn-link-dark btn-sm">Move to cart</button>
                                    </form>
                                </td>

                                <td>
                                    <select name="" id="" class="form-control" style="width: 4.7em" >
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                    </select>
                                </td>
                                <td>${{ $item->total() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h3>There is no item in your save for later</h3>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

        $(document)
            .on('change', '.quantity', function (event) {
                event.preventDefault();

                var data = {
                    id : this.getAttribute('data-id'),
                    quantity: this.value,
                    _method: 'PATCH'
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'cart/' + data.id,
                    type: 'POST',
                    data:data,
                    dataType: 'json',
                    async: true
                })
                    .done(function ajaxDone(data) {
                        location.reload();
                    })
                    .fail(function ajaxFailed(e) {
                        location.reload();
                    })
                    .always(function ajaxAlwaysDoThis(data) {
                        console.log("always");
                    });
                return false;
            });
    </script>
@endsection