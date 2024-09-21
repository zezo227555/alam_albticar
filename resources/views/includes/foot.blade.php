<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
{{-- data table 2 --}}
<script src="{{ asset('plugins/data_table_exporting/jquery.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons_html5.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons_print.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/Stuk-jszip-2ceb998/dist/jszip.min.js') }}"></script>
<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
{{-- sweet alert 2 --}}
<script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
{{-- select 2 --}}
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('dist/js/fa.all.min.js') }}"></script>

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
        theme: 'bootstrap4'
      });
    });
</script>

<script>
    $('#datatable').DataTable({
        dom: '<"row mb-2"<"col-sm-6"f><"col-sm-6 text-right"B>>' +
        't'+
        "<'row mt-2'<'col-sm-7'p>>",
        buttons: [
            'excel',
            'print',
        ],
        language: {
            search: "بحث:",
        },
        paging: true,
        pageLength: 50
    });
</script>

<script>
    $('.delete_button').on('click', function(e) {
    e.preventDefault();
    Swal.fire({
            title: 'هل انت متأكد من أنك تريد حذف السجل ؟',
            text: 'لا يمكن التراجع عن عملية الحذف',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم قم بالحذف',
            cancelButtonText: 'الغاء',
            }).then((result) => {
            if (result.isConfirmed) {
                    $(this).closest('.form_delete').submit();
            }
        });
    });
</script>

@if (session()->has('success'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "حدث خطأ",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

