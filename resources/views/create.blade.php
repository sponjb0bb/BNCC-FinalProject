<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header">
            <h3>Create Item</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>

                    <select name="category_id" class="form-select">

                        <option value="">-- Select Category --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->category }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Item Name -->
                <div class="mb-3">
                    <label class="form-label">Item Name</label>

                    <input 
                        type="text" 
                        name="name" 
                        class="form-control"
                        placeholder="Enter item name"
                    >
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="price" class="form-control"placeholder="Enter item price">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control"placeholder="Enter stock quantity">
                </div>

                <div class="mb-3">
                    <label class="form-label">Item Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Item
                </button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>