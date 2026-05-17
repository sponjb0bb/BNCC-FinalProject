<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Print Invoice</h3>
        </div>

        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="row">

                <!-- Item Image -->
                <div class="col-md-4 text-center">

                    <img
                        src="{{ asset('storage/images/' . $item->image) }}"
                        class="img-fluid rounded"
                        width="300"
                    >

                </div>

                <!-- Item Information -->
                <div class="col-md-8">

                    <h3>{{ $item->name }}</h3>

                    <p class="text-muted">
                        Category:
                        {{ $item->category->category }}
                    </p>

                    <h4 class="text-success">
                        Rp. {{ number_format($item->price) }}
                    </h4>

                    <p>
                        Available Stock:
                        <strong>{{ $item->stock }}</strong>
                    </p>

                    <hr>

                    <form action="{{ route('invoice.store', $item->id) }}" method="POST">

                        @csrf

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label">
                                Quantity
                            </label>
                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control"
                                min="1"
                                max="{{ $item->stock }}"
                                value="1"
                                required
                            >
                            <small class="text-danger">
                                Quantity cannot exceed available stock.
                            </small>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Shipping Address
                            </label>
                            <textarea
                                name="shipping_address"
                                class="form-control"
                                rows="3"
                                placeholder="Enter shipping address"
                                required
                            ></textarea>

                        </div>

                        <!-- Postal Code -->
                        <div class="mb-3">
                            <label class="form-label">
                                Postal Code
                            </label>
                            <input
                                type="text"
                                name="postal_code"
                                class="form-control"
                                placeholder="Enter postal code"
                                required
                            >
                        </div>

                        <!-- Total Price -->
                        <div class="mb-3">

                            <label class="form-label">
                                Total Price
                            </label>

                            <input
                                type="text"
                                id="totalPrice"
                                class="form-control"
                                value="Rp. {{ number_format($item->price) }}"
                                readonly
                            >

                        </div>

                        <!-- Print Button -->
                        <button type="submit" class="btn btn-success">
                            Print Invoice
                        </button>

                        <!-- Back Button -->
                        <a href="{{ route('user.page') }}" class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    const quantityInput = document.getElementById('quantity');

    const totalPriceInput = document.getElementById('totalPrice');

    const itemPrice = {{ $item->price }};

    const maxStock = {{ $item->stock }};

    quantityInput.addEventListener('input', function(){

        let quantity = parseInt(quantityInput.value);

        // prevent quantity below 1
        if(quantity < 1 || isNaN(quantity)){
            quantity = 1;
            quantityInput.value = 1;
        }

        // prevent quantity exceeding stock
        if(quantity > maxStock){
            quantity = maxStock;
            quantityInput.value = maxStock;

            alert('Quantity cannot exceed available stock!');
        }

        // calculate total
        const total = quantity * itemPrice;

        totalPriceInput.value =
            'Rp. ' + total.toLocaleString('id-ID');

    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>