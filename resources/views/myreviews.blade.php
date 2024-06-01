<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Reviews') }}
        </h2>
    </x-slot>
    @if ($productReviews->isNotEmpty())
        @foreach ($productReviews as $productReview)
            <section class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded" style="background-image: url(https://mdbcdn.b-cdn.net/img/Photos/Others/background2.webp);">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body m-3">
                                <div class="row">
                                    <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                                        @if($productReview->product_id)
                                            <img src="{{ asset('storage/' . $productReview->image1_url) }}" class="rounded-circle img-fluid shadow-1" alt="product_image" width="200" height="200" />
                                        @else
                                            <span></span>
                                        @endif
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-muted fw-light mb-4">
                                            {{ $productReview->comment }}
                                        </p>
                                        <p class="fw-bold lead mb-2"><strong>{{ $productReview->product_name }}</strong></p>
                                        <p class="fw-bold text-muted mb-0">{{ $productReview->category_name }}</p>
                                        
                                        <div class="rating">
                                            @for ($i = 1; $i <= $productReview->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                @if($productReview->product_id)
                                    <a href="{{ url('delete_review', $productReview->id) }}" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash3-fill"></i> Remove
                                    </a>
                                @else
                                    <span>No reviews yet.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        <p class="text-center p-3 bg-light border rounded shadow-sm">No reviews found</p>
    @endif
</x-app-layout>
