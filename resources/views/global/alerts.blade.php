<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if (session()->has('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            style: {
                background: "#38c172",
            }
        }).showToast();
    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: "{{ $error }}",
                duration: 3000,
                style: {
                    background: "#e3342f",
                }
            }).showToast();
        </script>
    @endforeach
@endif
@if (session()->has('info'))
    <script>
        Toastify({
            text: "{{ session('info') }}",
            duration: 3000
        }).showToast();
    </script>
@endif


@if (session()->has('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            style: {
                background: "#e3342f",
            }
        }).showToast();
    </script>
@endif
