<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            <img
                src="/images/dashboard-store-logo.svg"
                alt="Store Logo"
                class="my-4"
            />
        </a>
    </div>
    <div class="list-group list-group-flush">
        <a
            href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }}"
        >
            Dashboard
        </a>
        <a
            href="{{ route('dashboard.products') }}"
            class="list-group-item list-group-item-action {{ (request()->is('dashboard/products*')) ? 'active' : '' }}"
        >
            My Products
        </a>
        <a
            href="{{ route('dashboard.transactions') }}"
            class="list-group-item list-group-item-action {{ (request()->is('dashboard/transactions*')) ? 'active' : '' }}"
        >
            Transactions
        </a>
        <a
            href="{{ route('dashboard.settings.store') }}"
            class="list-group-item list-group-item-action {{ (request()->is('dashboard/settings*')) ? 'active' : '' }}"
        >
            Store Settings
        </a>
        <a
            href="{{ route('dashboard.settings.account') }}"
            class="list-group-item list-group-item-action {{ (request()->is('dashboard/account*')) ? 'active' : '' }}"
        >
            My Account
        </a>
        <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            Sign Out
        </a>
    </div>
</div>