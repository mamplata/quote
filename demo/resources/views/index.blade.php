<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Search Laravel Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://res.cloudinary.com/dy0sbkf3u/raw/upload/Dialog.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Search Quotes</h1>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-search"></i> Search for Quotes</h5>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" id="quoteSearchInput" class="form-control" placeholder="Enter keywords" required>
                    <button class="btn btn-primary" type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="text-center mb-4 d-flex justify-content-center">
            <div class="col-12 col-md-4"> <!-- Bootstrap grid for responsiveness -->
                <button class="btn btn-success w-100 p-2" data-bs-toggle="modal" data-bs-target="#quoteModal" id="addQuoteButton">
                    <i class="fas fa-plus"></i> Add Quote
                </button>
            </div>
        </div>

        @include('editor')
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list-alt"></i> Results</h5>
            </div>
            <div id="resultsContainer" class="card-body">
                @include('search_results', ['quotes' => $quotes])
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/script.js') }}"></script>
</body>

</html>