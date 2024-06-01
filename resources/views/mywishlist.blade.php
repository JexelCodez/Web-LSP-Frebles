<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wishlist') }}
        </h2>
    </x-slot>

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Category</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @if ($wishlists->isNotEmpty())
                            @foreach ($wishlists as $wishlist)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">

                                            @if($wishlist->product_id)
                                            <a href="{{ route('landingpage-items.product-details', $wishlist->product_id) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset('storage/' . $wishlist->image1_url) }}" style="width: 50px; height: 50px" alt="product_image">
                                                    {{ $wishlist->product_name }}
                                                </label>
                                            </a>
                                            @else
                                                <span>{{ $wishlist->product_name }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">Rp{{ number_format($wishlist->price, 0) }} </label>
                                        </div>

                                        <div class="col-md-2 my-auto">
                                            <label class="price">{{ $wishlist->category_name }} </label>
                                        </div>

                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <a href="{{ url('delete_wish', $wishlist->id) }}" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center p-3 bg-light border rounded shadow-sm">No Orders found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
