<!-- resources/views/quotes/search_results.blade.php -->
<div class="container mt-4">
    @if($quotes->isEmpty())
    <div class="alert alert-warning text-center fs-3" role="alert">
        No quotes found.
    </div>
    @else
    <h2 class="mb-3 text-center" style="color: #d4a42c;">Search Results</h2>
    <div class="row">
        @foreach($quotes as $quote)
        <div class="col-md-4 mb-4">
            <div class="card h-100 card-snow position-relative">
                <!-- Action buttons at the top-right corner -->
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <button class="btn btn-sm btn-warning editQuoteButton" data-id="{{ $quote->id }}" data-quote="{{ $quote->quote }}" data-author="{{ $quote->author }}" data-bs-toggle="modal" data-bs-target="#quoteModal">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger deleteQuoteButton" data-id="{{ $quote->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>

                <!-- Add padding to the card body to prevent content overlap -->
                <div class="card-body pt-5">
                    <hr class="my-3">
                    <blockquote class="blockquote mb-0">
                        <p>"{{ $quote->quote }}"</p>
                        <footer class="blockquote-footer">{{ $quote->author }}</footer>
                    </blockquote>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .card-snow {
        background-color: #FFFAFA;
        border: 1px solid #ddd;
    }

    .btn-sm {
        padding: 4px 6px;
        font-size: 0.8rem;
    }

    .card-body {
        padding-top: 2rem;
        /* Extra padding to prevent overlap with icons */
    }
</style>