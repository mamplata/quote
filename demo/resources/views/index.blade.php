<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --cafe-brown: #4B3D3D;
            /* Dark brown */
            --cafe-beige: #E8D5C4;
            /* Light beige */
            --cafe-cream: #F3E6D5;
            /* Off-white */
            --cafe-green: #4A7C2A;
            /* Green */
            --cafe-dark-green: #3A5A1D;
            /* Dark green for buttons */
            --cafe-highlight: #FFD700;
            /* Gold for highlights */
        }

        body {
            background-color: var(--cafe-cream);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            background-color: var(--cafe-beige);
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: var(--cafe-brown);
            color: var(--cafe-highlight);
            /* Gold color for contrast */
        }

        .btn-primary {
            background-color: var(--cafe-dark-green);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--cafe-green);
            transform: scale(1.05);
            /* Slight scaling effect on hover */
        }

        #resultsContainer {
            max-height: 400px;
            /* Increased height */
            overflow-y: auto;
            /* Enable vertical scrolling */
            padding: 20px;
            /* Add padding for better spacing */
            text-align: left;
            /* Align text to the left */
        }

        .no-results {
            font-size: 1.2rem;
            /* Slightly larger font size */
            color: #333;
            /* Darker text color for better visibility */
            margin-top: 20px;
            /* Margin for spacing */
        }

        /* Styling for search input and button */
        .input-group input {
            border: 2px solid var(--cafe-brown);
            /* Dark border for contrast */
        }

        .input-group input:focus {
            border-color: var(--cafe-green);
            /* Green border on focus */
            box-shadow: 0 0 5px var(--cafe-green);
            /* Shadow effect */
        }
    </style>
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

        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list-alt"></i> Results</h5>
            </div>
            <div id="resultsContainer" class="card-body mt-2">
                <p class="no-results">Search results will appear here.</p> <!-- Default message -->
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#quoteSearchInput').on('input', function() {
                let keywords = $(this).val();

                // Check if input is not empty
                if (keywords.length > 0) {
                    // AJAX request
                    $.ajax({
                        url: '/search',
                        method: 'POST',
                        data: {
                            keywords: keywords,
                            _token: '{{ csrf_token() }}' // Add CSRF token for Laravel
                        },
                        success: function(data) {
                            // Update the results container with the response data
                            $('#resultsContainer').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            $('#resultsContainer').html('<p class="text-danger">An error occurred while searching. Please try again.</p>');
                        }
                    });
                } else {
                    // Show default message if input is empty
                    $('#resultsContainer').html('<p class="no-results">Search results will appear here.</p>');
                }
            });
        });
    </script>
</body>

</html>