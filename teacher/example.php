<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal and SweetAlert2 Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bootstrap Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    This is a Bootstrap modal.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="triggerAlert">Trigger SweetAlert2</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Open Modal
    </button>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    <script>
    document.getElementById('triggerAlert').addEventListener('click', function() {
        // Temporarily remove the 'modal-open' class from the body
        document.body.classList.remove('modal-open');

        Swal.fire({
            title: 'SweetAlert2 Form',
            html: `<input type="text" id="swal-input1" class="swal2-input" placeholder="Enter something">
                       <input type="password" id="swal-input2" class="swal2-input" placeholder="Enter password">`,
            focusConfirm: false,
            preConfirm: () => {
                const input1 = Swal.getPopup().querySelector('#swal-input1').value;
                const input2 = Swal.getPopup().querySelector('#swal-input2').value;
                if (!input1 || !input2) {
                    Swal.showValidationMessage(`Please enter both fields`);
                }
                return {
                    input1: input1,
                    input2: input2
                };
            },
            didOpen: () => {
                // Add the 'modal-open' class back to the body
                document.body.classList.add('modal-open');
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result.value);
                // Process the form data here
            }
        });
    });
    </script>
</body>

</html>