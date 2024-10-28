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
    $(".editQuoteButton").click(function () {
        const quoteId = $(this).data("id");
        const quote = $(this).data("quote");
        const author = $(this).data("author");
        console.log(quoteId, quote, author);

        $("#quoteModalLabel").text("Edit Quote");
        $("#saveQuoteButton").text("Save Changes");
        $("#quoteId").val(quoteId);
        $("#quote").val(quote);
        $("#author").val(author);
        $("#quoteForm")[0].reset();
    });

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
                },
                success: function (data) {
                    Dialog.showPlainDialog(
                        `<p class='text-center fs-3'>
                            <strong>Quote Successfully Change<strong>
                        </p>`,
                        {
                            backdrop: {
                                "background-color": "#F3E6D5",
                                "backdrop-filter": "blur(10px)",
                            },
                            dialog: {
                                "background-color": "#fff",
                            },
                            button: { color: "red" },
                            eventStyles: {
                                button: {
                                    mouseover: { "background-color": "green" },
                                    mouseout: { "background-color": "yellow" },
                                },
                            },
                        }
                    );
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
                    Dialog.showPlainDialog(
                        `<p class='text-center fs-3'>
                            <strong>Quote Successfully Added<strong>
                        </p>`,
                        {
                            backdrop: {
                                "background-color": "#F3E6D5",
                                "backdrop-filter": "blur(10px)",
                            },
                            dialog: {
                                "background-color": "#fff",
                            },
                            button: { color: "red" },
                            eventStyles: {
                                button: {
                                    mouseover: { "background-color": "green" },
                                    mouseout: { "background-color": "yellow" },
                                },
                            },
                        }
                    );
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
    $(".deleteQuoteButton").click(function () {
        const quoteId = $(this).data("id");
        $("#confirmDeleteButton").data("id", quoteId);
        $("#deleteModal").modal("show");
    });

    // Confirm Delete
    $("#confirmDeleteButton").click(function () {
        const quoteId = $(this).data("id");
        $.ajax({
            url: `/quotes/${quoteId}`, // Update this URL based on your routing
            method: "DELETE",
            success: function () {
                location.reload(); // Reload the page
            },
        });

        $("#deleteModal").modal("hide");
    });
});
