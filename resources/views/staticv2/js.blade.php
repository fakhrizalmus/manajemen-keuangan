<!-- [Page Specific JS] start -->
<script src="{{ asset('assets/js/pages/chart-apex.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<script src="../assets/js/plugins/apexcharts.min.js"></script>
{{-- <script src="../assets/js/pages/dashboard-default.js"></script> --}}
<!-- [Page Specific JS] end -->
<!-- Required Js -->
<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/fonts/custom-font.js"></script>
<script src="../assets/js/pcoded.js"></script>
<script src="../assets/js/plugins/feather.min.js"></script>

{{-- toastr --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    }
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
