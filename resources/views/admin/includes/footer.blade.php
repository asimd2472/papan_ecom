<footer class="site-footer">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <div class="copyright-text">
                <p>Copyright © {{date('Y')}} <a href="{{url('/')}}" target="_blank">#</a> All rights reserved.</p>
            </div>
        </div>
        <div class="col-auto">
            <div class="develope-text">
                <p>developed by <a href="#">Asim</a></p>
            </div>
        </div>
    </div>
</footer>

<script type="module">
    @if (Session::has('success'))
        $(document).ready(function() {
            Swal.fire({
                title: 'Success',
                text: '{{ Session::get('success') }}',
                icon: 'success',
            });
        });
    @endif

    @if (Session::has('error'))
        $(document).ready(function() {
            Swal.fire({
                title: 'Success',
                text: '{{ Session::get('error') }}',
                icon: 'warning',
            });
        });
    @endif
</script>
