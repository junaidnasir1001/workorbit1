<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>


<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
{{-- sweetalert2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.js"
        integrity="sha512-IHQXMp2ha/aGMPumvzKLQEs9OrPhIOaEXxQGV5vnysMtEmNNcmUqk82ywqw7IbbvrzP5R3Hormh60UVDBB98yg=="
        crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{  asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.j') }}s"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(document).ready(function () {
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function () {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function () {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        jQuery.validator.addMethod("mobile", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/);
        }, "Please specify a valid phone number");

        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');

        $.validator.addMethod("greaterThan", function (value, element, params) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val())
                || (Number(value) > Number($(params).val()));
        }, 'Must be greater than {0}.');

        $.chk_duplicate_arr = function (arr) {
            var unique_list = [];
            var duplicates_list = [];
            $.each(arr, function (key, value) {
                if ($.inArray(value, unique_list) == -1) {
                    unique_list.push(value);
                } else {
                    if ($.inArray(value, duplicates_list) == -1) {
                        duplicates_list.push(value);
                    }
                }
            });
            return duplicates_list;
        }

    });

    function loader() {
        Swal.fire({
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading()
            },
        });
    }

    function alertMsg(msg, status = 'success') {
        Swal.fire({
            icon: status,
            title: msg,
            showConfirmButton: false,
            timer: 1500
        });
    }

</script>



