<!-- resources/views/quotes/search_results.blade.php -->
<style>
    body {
        background-color: #f8f4e3;
        /* Light cream background */
    }

    .quote-item {
        font-size: 0.5rem;
        /* Smaller font size */
        color: #5b3e36;
        /* Dark coffee color for text */
    }

    .blockquote {
        border-left: 5px solid #d4a42c;
        /* Gold left border */
        padding-left: 1rem;
        /* Padding for blockquote */
        margin-bottom: 0;
        /* Remove bottom margin */
    }

    .alert {
        background-color: #ffe0b2;
        /* Light orange alert background */
        color: #5b3e36;
        /* Dark coffee color for alert text */
    }
</style>

<div class="container mt-4">
    @if($quotes->isEmpty())
    <div class="alert alert-warning" role="alert">
        No quotes found.
    </div>
    @else
    <h2 class="mb-3 text-center" style="color: #d4a42c;">Search Results</h2>
    <ul class="list-group">
        @foreach($quotes as $quote)
        <li class="list-group-item quote-item">
            <blockquote class="blockquote mb-0">
                <p>"{{ $quote->quote }}"</p>
                <footer class="blockquote-footer">{{ $quote->author }}</footer>
            </blockquote>
        </li>
        @endforeach
    </ul>
    @endif
</div>