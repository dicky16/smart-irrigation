<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TA | {{ $title }}</title>
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    {{-- <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE//dist/css/adminlte.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/ch'art.js"></script>
</head>

<body>
    <nav class="sidebar close position-fixed ">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{url('Gambar/OIP.jfif')}}" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Monitoring</span>
                    <span class="profession">Irigasi</span>
                </div>
            </div>

            <i class='bi bi-chevron-compact-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">


                <li class="">
                    <a class="{{ ($title === "Dashboard") ? 'active' : '' }}" href="/?id=1">
                        <i class='bi bi-house icon'></i>
                        <span class="text nav-text ">Dashboard</span>
                    </a>
                </li>
                @can('user')
                <li class="">
                    <a class="{{ ($title === "temp") ? 'active' : '' }}" href="{{ ('/temp/?id=1') }}">
                        <i class='fa bi-thermometer icon'></i>
                        <span class="text nav-text">Suhu</span>
                    </a>
                </li>
                <li class="">
                    <a class="{{ ($title === "soil") ? 'active' : '' }}" href="{{ url('/soil/?id=1') }}">
                        <i class='bx bi-bar-chart-fill icon'></i>
                        <span class="text nav-text">Kelembapan Tanah</span>
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ url('/contactus') }}">
                        <i class='bi bi-envelope icon'></i>
                        <span class="text nav-text">Contact Us</span>
                    </a>
                </li>
                @endcan
                @can('is_admin')
                <li class="">
                    <a class="{{ ($title === "temp") ? 'active' : '' }}" href="{{ ('/temp/?id=1') }}">
                        <i class='bx bi-thermometer icon'></i>
                        <span class="text nav-text">Suhu</span>
                    </a>
                </li>
                <li class="">
                    <a class="{{ ($title === "soil") ? 'active' : '' }}" href="{{ url('/soil/?id=1') }}">
                        <i class='bx bi-bar-chart-fill icon'></i>
                        <span class="text nav-text">Kelembapan Tanah</span>
                    </a>
                </li>
                @endcan

                @can('is_admin')
                <li class="">
                    <a class="" href="{{ url('admin/pesan/pesan') }}">
                        <i class='bi bi-chat-left-text icon'></i>
                        <span class="text nav-text">Pesan</span>
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ url('/admin/deskripsi/deskripsi') }}">
                        <i class='bi bi-file icon'></i>
                        <span class="text nav-text">Input data</span>
                    </a>
                </li>

                <li class="">
                    <a class="" href="{{ url('/admin/lokasi/lokasi') }}">
                        <i class='bi bi-geo-alt icon'></i>
                        <span class="text nav-text">Lokasi</span>
                    </a>
                </li>
                @endcan

            </div>

            <div class="bottom-content">
                @auth
                <form action="/logout" class="row" method="post">
                    @csrf
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-expanded="false">
                            {{-- <i class='bi bi-box-arrow-right icon' ></i> --}}
                            Welcome, {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><button class="dropdown-item">Logout</button></li>
                        </ul>
                    </div>
                </form>
                @else
                <li class="">
                    <a class="" href="{{ url('/login') }}">
                        <i class='bi bi-box-arrow-right icon'></i>
                        <span class="text nav-text">Login</span>
                    </a>
                </li>
                @endauth
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bi bi-moon icon moon'></i>
                        <i class='bi bi-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>
    </nav>
    <section class="home">
        @yield('home')
    </section>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/trix.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <!-- DataTables  & Plugins -->
    <!-- jQuery -->

    {{-- <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    {{-- <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script> --}}
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script> --}}
    {{-- <script>
    $(function () {
    $("#tabel-nh3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabel-temp').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Temperature Hari'
                }, ]
            });
        });
        $(document).ready(function () {
            $('#tabel-temp-bulan').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Temperature Bulan'
                }, ]
            });
        });
        $(document).ready(function () {
            $('#tabel-temp-detik').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Temperature Detik'
                }, ]
            });
        });

        $(document).ready(function () {
            $('#tabel-soil').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Kelembapan Tanah Hari'
                }, ]
            });
        });
        $(document).ready(function () {
            $('#tabel-soil-bulan').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Kelembapan Tanah Bulan'
                }, ]
            });
        });
        $(document).ready(function () {
            $('#tabel-soil-detik').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Data Kelembapan Tanah Detik'
                }, ]
            });
        });

        $(document).ready(function () {
            $('#tabel-nh3-detik').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                ]
            });
        });
        $(document).ready(function () {
            $('#tabel-nh3-bulan').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                ]
            });
        });
        $(document).ready(function () {
            $('#tabel-ch4').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                ]
            });
        });
        $(document).ready(function () {
            $('#tabel-ch4-bulan').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                ]
            });
        });
        $(document).ready(function () {
            $('#tabel-co').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                ]
            });
        });
        $(document).ready(function () {
            $('#tabel-co-bulan').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    'excelHtml5',
                ]
            });
        });
    </script>
    <section class="js">
        @yield('js')
    </section>


</body>

</html>