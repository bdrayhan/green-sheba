@include('staff.includes.header')

@include('staff.includes.navbar')

@include('staff.includes.sidebar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @yield('staff_content')
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- Other Text Here -->
</div>
@include('staff.includes.footer')
