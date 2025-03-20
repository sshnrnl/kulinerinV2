<div class="modal fade" id="editTableModal" tabindex="-1" aria-labelledby="editTableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTableLabel">Edit Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTableForm" method="POST">
                    @csrf
                    <input type="hidden" id="tableId" name="tableId">

                    <div class="mb-3">
                        <label for="editTableCapacity" class="form-label">Table Capacity</label>
                        <input type="text" class="form-control" id="editTableCapacity" name="tableCapacity">
                    </div>
                    <div class="mb-3">
                        <label for="editAvailTable" class="form-label">Available Table</label>
                        <input type="text" class="form-control" name="availableTables" id="editAvailTable">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Load Data to Modal for Editing
        $('#editTableModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var tableId = button.data('id');

            $.ajax({
                url: "/table/" + tableId + "/edit",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#tableId').val(data.id);
                    $('#editTableCapacity').val(data.tableCapacity);
                    $('#editAvailTable').val(data.availableTables);

                    // Update action form
                    $('#editTableForm').attr('action', "/table/" + tableId + "/update");
                },
                error: function() {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to load table data.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });

        // Update Data on Submit
        $('#editTableForm').on('submit', function(event) {
            event.preventDefault(); // Prevent page reload

            var formData = new FormData(this);
            var tableId = $('#tableId').val();

            $.ajax({
                url: "/table/" + tableId + "/update",
                type: "POST", // Laravel masih menerima POST meskipun PUT dikirim lewat _method
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.btn-primary').prop('disabled', true).text('Saving...');
                },
                success: function(response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Table updated successfully!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        $('#editTableModal').modal('hide');
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errorMessage = "An error occurred.";

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorList = "";

                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                errorList += message + "<br>";
                            });
                        });

                        errorMessage = errorList;
                    }

                    Swal.fire({
                        title: "Error!",
                        html: errorMessage,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                },
                complete: function() {
                    $('.btn-primary').prop('disabled', false).text('Save Changes');
                }
            });
        });
    });
</script>
