@include('backend.includes.header')

@include('backend.includes.navbar')

@include('backend.includes.sidebar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @yield('admin_content')

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Other Text Here -->
</div>

@include('backend.includes.footer')
