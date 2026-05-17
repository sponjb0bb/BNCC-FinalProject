<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Item Catalog</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Item Catalog</h2>
        <div>
            <form action="{{ route('logout') }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>
            
            <!-- Back To Admin -->
            @if(Auth::user()->role == 'admin')
            
            <a href="{{ route('item.index') }}" class="btn btn-dark">
                Back To Admin
            </a>
            
            @endif
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th width="180">Invoice</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($items as $item)

                        <tr>

                            <td>{{ $item->id }}</td>

                            <td>

                                <img 
                                    src="{{ asset('storage/images/' . $item->image) }}"
                                    width="100"
                                >

                            </td>

                            <td>
                                {{ $item->category->category }}
                            </td>

                            <td>
                                {{ $item->name }}
                            </td>

                            <td>
                                Rp. {{ number_format($item->price) }}
                            </td>

                            <td>

                                @if($item->stock <= 0)

                                    <span class="badge bg-danger">
                                        Out of Stock
                                    </span>

                                @else

                                    {{ $item->stock }}

                                @endif

                            </td>

                            <td>

                                @if($item->stock <= 0)

                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Out of Stock
                                    </button>

                                @else

                                    <a 
                                        href="{{ route('invoice.index', $item->id) }}"
                                        class="btn btn-success btn-sm"
                                    >
                                        Create Invoice
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                No items available
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>