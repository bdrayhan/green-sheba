<div class="col-lg-4">
    <div class="card shadow-none mb-3 mb-lg-0 border rounded-0">
        <div class="card-body">
            <div class="list-group list-group-flush">
                <a href="{{ route('web.user.account') }}"
                    class="list-group-item {{ Route::currentRouteName() == 'web.user.account' ? 'active' : 'bg-transparent' }} d-flex justify-content-between align-items-center">Dashboard
                    <i class='bx bx-tachometer fs-5'></i></a>
                <a href="{{ route('web.user.address') }}"
                    class="list-group-item {{ Route::currentRouteName() == 'web.user.address' ? 'active' : 'bg-transparent' }} d-flex justify-content-between align-items-center">Addresses
                    <i class='bx bx-home-smile fs-5'></i></a>
                <a href="{{ route('web.user.details') }}"
                    class="list-group-item {{ Route::currentRouteName() == 'web.user.details' ? 'active' : 'bg-transparent' }} d-flex justify-content-between align-items-center">Account
                    Details <i class='bx bx-user-circle fs-5'></i></a>
                <a onclick="document.getElementById('logout-form').submit();" href="javascript:;"
                    class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Logout
                    <i class='bx bx-log-out fs-5'></i></a>
                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
