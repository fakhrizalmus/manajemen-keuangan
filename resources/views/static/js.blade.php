<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="../admin/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="../admin/assets/demo/chart-area-demo.js"></script>
<script src="../admin/assets/demo/chart-bar-demo.js"></script>
<script src="../admin/assets/demo/chart-pie-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="../admin/js/datatables-simple-demo.js"></script>
<!-- jQuery & Toastr JS -->
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
<script>
    const jumlahInput = document.getElementById('jumlah');
    const rupiahInput = document.getElementById('rupiah');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    if (jumlahInput && rupiahInput) {
        jumlahInput.addEventListener('input', function() {
            const jumlah = parseInt(this.value) || 0;
            rupiahInput.value = formatRupiah(jumlah);
        });
    }
</script>
