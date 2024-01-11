<!-- ----------------------Footer------------------ -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy;  Education Commitee</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        //Datable  add csv file 
        var empDataTable = $('#example').DataTable({
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                            10] // Column index which needs to export
                    }
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                }
            ]
        });

    // Show Password Input in Admin Profile
        $('#show_password').on('click', function() {
            var passInput = $("#e_password");
            console.log('passInput', passInput);
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });
    });
</script>
</body>

</html>