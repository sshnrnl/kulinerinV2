<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMenuForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="menuId" name="menuId">

                    <div class="mb-3">
                        <label for="editMenuName" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="editMenuName" name="menuName">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="" disabled>Select Category</option>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main Course">Main Course</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Beverages">Beverages</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editMenuPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" name="menuPrice" id="editMenuPrice" required
                            oninput="formatPrice(this)">
                    </div>

                    <div class="mb-3">
                        <label for="editMenuImage" class="form-label">Menu Image</label>
                        <input class="form-control" name="menuImage" id="updateImage" type="file"
                            accept=".jpg,.jpeg,.png" onchange="previewImage(event, 'UpdateImgPreview')">
                        <img src="" id="UpdateImgPreview" class="img-preview img-fluid d-block mt-3 col-sm-4"
                            style="display: none;">
                    </div>


                    <div class="mb-3">
                        <label for="isAVailable" class="form-label">Available</label>
                        <select class="form-control" name="isAVailable" id="isAVailable" required>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editDescription"></textarea>
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
    //PRICE FORMAT
    function formatPrice(input) {
        // Hapus semua karakter selain angka
        let value = input.value.replace(/,/g, '');

        // Format ulang dengan koma sebagai pemisah ribuan
        input.value = new Intl.NumberFormat('en-US').format(value);
    }
    //PREVIEW IMAGE
    function previewImage(event, previewId) {
        const input = event.target; // Ambil elemen input file
        const imgPreview = document.getElementById(previewId); // Pilih elemen img berdasarkan ID

        if (input.files && input.files[0]) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.style.display = 'block';
                imgPreview.src = oFREvent.target.result;
            };
        }
    }



    //GET DATA TO EDIT
    $(document).ready(function() {
        $('#editMenuModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var menuId = button.data('id');

            // Panggil data dari server
            $.ajax({
                url: "/menu/" + menuId + "/edit",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#menuId').val(data.id);
                    $('#editMenuName').val(data.menuName);
                    $('#editMenuPrice').val(parseFloat(data.menuPrice).toLocaleString(
                        'en-US'));
                    $('#isAVailable').val(data.isAVailable);
                    $('#editDescription').val(data.description);

                    // Menyesuaikan value kategori yang sesuai dalam dropdown
                    $('#category').val(data.category);

                    // Jika masih tidak berfungsi, paksa perubahan dengan looping
                    $('#category option').each(function() {
                        if ($(this).val() == data.category) {
                            $(this).prop('selected', true);
                        }
                    });

                    if (data.menuImage) {
                        $('.img-preview').attr('src', '/storage/' + data.menuImage);
                    } else {
                        $('.img-preview').attr('src', '');
                    }

                    // Update action form
                    $('#editMenuForm').attr('action', "/menu/" + menuId + "/update");
                },
                error: function() {
                    alert('Gagal mengambil data menu');
                }
            });
        });

        // Format input saat user mengetik
        $('#editMenuPrice').on('input', function() {
            formatPrice(this);
        });
    });

    //SAVE DB
    $(document).ready(function() {
        $('#editMenuForm').on('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            var formData = new FormData(this); // Ambil data dari form
            var menuId = $('#menuId').val(); // Ambil ID menu yang akan diedit

            $.ajax({
                url: "/menu/" + menuId + "/update", // Endpoint update
                type: "POST",
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
                        text: "Menu updated successfully!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        $('#editMenuModal').modal('hide'); // Tutup modal
                        $('#imgPreview').hide();
                        location.reload(); // Refresh halaman agar data diperbarui
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
                        html: errorMessage, // Gunakan "html" agar pesan error bisa menampilkan <br>
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                },
                complete: function() {
                    $('.btn-primary').prop('disabled', false).text('Update');
                }
            });
        });
    });
</script>
