<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Item List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Item List</h2>

        <div>
            <form action="{{ route('logout') }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>

            <!-- Print Invoice Button -->
            <a href="{{ route('user.page') }}" class="btn btn-success me-2">
                Print Invoice
            </a>

            <!-- Create Button -->
            <a href="{{ route('item.create') }}" class="btn btn-primary">
                Create Item
            </a>

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
                        <th width="180">Action</th>
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
                                {{ $item->stock }}
                            </td>

                            <td>

                                <!-- Edit Button -->
                                <a 
                                    href="{{ route('item.edit', $item->id) }}" 
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form 
                                    action="{{ route('item.destroy', $item->id) }}" 
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this item?')"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">
                                No items found
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