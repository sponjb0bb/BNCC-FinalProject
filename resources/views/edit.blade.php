<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Item</h3>
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

            <form 
                action="{{ route('item.update', $item->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <!-- Category -->
                <div class="mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select name="category_id" class="form-select">

                        @foreach($categories as $category)

                            <option 
                                value="{{ $category->id }}"
                                {{ $item->category_id == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->category }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Item Name -->
                <div class="mb-3">

                    <label class="form-label">
                        Item Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $item->name }}"
                    >

                </div>

                <!-- Price -->
                <div class="mb-3">

                    <label class="form-label">
                        Price
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp.
                        </span>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ $item->price }}"
                        >

                    </div>

                </div>

                <!-- Stock -->
                <div class="mb-3">

                    <label class="form-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="{{ $item->stock }}"
                    >

                </div>

                <!-- Current Image -->
                <div class="mb-3">

                    <label class="form-label">
                        Current Image
                    </label>

                    <br>

                    <img
                        src="{{ asset('images/' . $item->image) }}"
                        width="150"
                        class="img-thumbnail"
                    >

                </div>

                <!-- New Image -->
                <div class="mb-3">

                    <label class="form-label">
                        New Image (Optional)
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                    >

                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning">
                    Update Item
                </button>

                <!-- Back Button -->
                <a href="{{ route('item.index') }}" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>