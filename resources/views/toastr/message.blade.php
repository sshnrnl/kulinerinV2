<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/kulinerinLogo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Display error messages if any
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif

            // Display success message if session has success message
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (isset($_COOKIE['success']))
                toastr.success("{{ $_COOKIE['success'] }}");
                unset($_COOKIE['success']);
                setcookie('success', '', time() - 3600, '/');
            @endif


        });
    </script>

</body>

</html>
