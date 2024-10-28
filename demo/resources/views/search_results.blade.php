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
            <div class="card h-100 card-snow">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>"{{ $quote->id }}"</p>
                        <p>"{{ $quote->quote }}"</p>
                        <footer class="blockquote-footer">{{ $quote->author }}</footer>
                    </blockquote>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-warning w-50 me-3 editQuoteButton" data-id="{{ $quote->id }}" data-quote="{{ $quote->quote }}" data-author="{{ $quote->author }}" data-bs-toggle="modal" data-bs-target="#quoteModal">Edit</button>
                    <button class=" btn btn-danger w-50 deleteQuoteButton" data-id="{{ $quote->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
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
        /* Snow color */
        border: 1px solid #ddd;
        /* Optional: add a light border for better visibility */
    }
</style>