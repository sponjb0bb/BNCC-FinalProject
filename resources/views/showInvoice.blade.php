<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice History</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Invoice History</h2>

        <a href="{{ route('user.page') }}" class="btn btn-primary">
            Back To Items
        </a>

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
                        <th>Invoice Number</th>
                        <th>Shipping Address</th>
                        <th>Postal Code</th>
                        <th>Total Price</th>
                        <th>Created At</th>
                        <th width="150">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($invoices as $invoice)

                        <tr>

                            <td>
                                {{ $invoice->id }}
                            </td>

                            <td>
                                {{ $invoice->invoice_number }}
                            </td>

                            <td>
                                {{ $invoice->shipping_address }}
                            </td>

                            <td>
                                {{ $invoice->postal_code }}
                            </td>

                            <td>
                                Rp. {{ number_format($invoice->total_price) }}
                            </td>

                            <td>
                                {{ $invoice->created_at->format('d M Y H:i') }}
                            </td>

                            <td>

                                <button
                                    onclick="window.print()"
                                    class="btn btn-success btn-sm"
                                >
                                    Print
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                No invoices found
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