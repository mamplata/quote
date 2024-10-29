$(document).ready(function () {
    const csrfToken = $("meta[name='csrf-token']").attr("content");
    $("#quoteSearchInput").on("input", function () {
        let keywords = $(this).val();

        // Check if input is not empty
        if (keywords.length >= 0) {
            // AJAX request
            $.ajax({
                url: "/search",
                method: "POST",
                data: {
                    keywords: keywords,
                    _token: csrfToken, // Add CSRF token for Laravel
                },
                success: function (data) {
                    // Update the results container with the response data
                    $("#resultsContainer").html(data);
                },
                error: function (xhr, status, error) {
                    let err = xhr.responseJSON.errors;
                    let errMessage = "";
                    Object.keys(err).forEach((key) => {
                        errMessage += err[key][0] + "\n";
                    });

                    $("#resultsContainer").html(
                        `<p class="text-danger text-center fs-3">${errMessage}</p>`
                    );
                },
            });
        }
    });

    // Open Add Modal
    $("#addQuoteButton").click(function () {
        $("#quoteModalLabel").text("Add Quote");
        $("#saveQuoteButton").text("Add Quote");
        $("#quoteForm")[0].reset();
        $("#quoteId").val("");
    });

    // Open Edit Modal
    // Use event delegation to attach the click event to dynamically loaded elements
    $(document).on("click", ".editQuoteButton", function () {
        const quoteId = $(this).data("id");
        const quote = $(this).data("quote");
        const author = $(this).data("author");

        $("#quoteModalLabel").text("Edit Quote");
        $("#saveQuoteButton").text("Save Changes");
        $("#quoteId").val(quoteId);
        $("#quote").val(quote);
        $("#author").val(author);
    });

    function DialogModal(eventText) {
        Dialog.showPlainDialog(
            `<div class="dialog-content" style="padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); position: relative;">
                <p class='text-center fs-3 mb-4'>
                    <strong>${eventText}</strong>
                </p>
            </div>`,
            {
                backdrop: {
                    "background-color": "#F3E6D5",
                    "backdrop-filter": "blur(10px)",
                },
                dialog: {
                    "background-color": "#fff",
                    border: "2px solid #4CAF50", // Green border
                    "border-radius": "10px",
                    padding: "10px",
                },
                button: {
                    "background-color": "red",
                    color: "white",
                    padding: "8px 16px",
                    border: "none",
                    "border-radius": "5px",
                    cursor: "pointer",
                },
                eventStyles: {
                    button: {
                        mouseover: { "background-color": "green" },
                        mouseout: { "background-color": "yellow" },
                    },
                },
            }
        );
    }

    // Save Quote (Add/Edit)
    $("#saveQuoteButton").click(function () {
        const quoteId = $("#quoteId").val();
        const quote = $("#quote").val();
        const author = $("#author").val();

        if (quoteId) {
            // Edit existing quote (Ajax call to update)
            $.ajax({
                url: `/updateQuote/${quoteId}`, // Update this URL based on your routing
                method: "PUT",
                data: {
                    quote: quote,
                    author: author,
                    _token: csrfToken,
                },
                success: function (data) {
                    DialogModal("Save Changes Successfully");
                    $("#resultsContainer").html(data);
                },
                error: function (xhr, status, error) {
                    let err = xhr.responseJSON.errors;
                    let errMessage = "";
                    Object.keys(err).forEach((key) => {
                        errMessage += err[key][0] + "\n";
                    });

                    $("#resultsContainer").html(
                        `<p class="text-danger text-center fs-3">${errMessage}</p>`
                    );
                },
            });
        } else {
            // Add new quote (Ajax call to create)
            $.ajax({
                url: "/addQuote", // Update this URL based on your routing
                method: "POST",
                data: {
                    quote: quote,
                    author: author,
                    _token: csrfToken,
                },
                success: function (data) {
                    DialogModal("Quote Added Successfully");
                    $("#resultsContainer").html(data);
                },
                error: function (xhr, status, error) {
                    let err = xhr.responseJSON.errors;
                    let errMessage = "";
                    Object.keys(err).forEach((key) => {
                        errMessage += err[key][0] + "\n";
                    });

                    $("#resultsContainer").html(
                        `<p class="text-danger text-center fs-3">${errMessage}</p>`
                    );
                },
            });
        }

        // Hide the modal after saving
        $("#quoteModal").modal("hide");
    });

    // Open Delete Modal
    $(document).on("click", ".deleteQuoteButton", function () {
        const quoteId = $(this).data("id");
        $("#confirmDeleteButton").data("id", quoteId);
        $("#deleteModal").modal("show");
    });

    // Confirm Delete
    $(document).on("click", "#confirmDeleteButton", function () {
        const quoteId = $(this).data("id");
        $.ajax({
            url: `/deleteQuote/${quoteId}`, // Update this URL based on your routing
            method: "DELETE",
            data: {
                _token: csrfToken,
            },
            success: function (data) {
                DialogModal("Quote Deleted Successfully");
                $("#resultsContainer").html(data);
            },
            error: function (xhr) {
                if (xhr.status === 404) {
                    DialogModal("Error: Quote not found.");
                } else {
                    DialogModal("An unexpected error occurred.");
                }
            },
        });

        $("#deleteModal").modal("hide");
    });
});
