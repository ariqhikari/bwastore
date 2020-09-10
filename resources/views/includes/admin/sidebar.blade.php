<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
            <img
                src="/images/admin.png"
                alt="Store Logo"
                class="my-4"
                style="max-width: 150px"
            />
        </a>
    </div>
    <div class="list-group list-group-flush">
        <a
            href="{{ route('admin.dashboard') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin')) ? 'active' : '' }}"
        >
            Dashboard
        </a>
        <a
            href="{{ route('product.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/product')) ? 'active' : '' }}"
        >
            Products
        </a>
        <a
            href="{{ route('product-gallery.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/product-gallery*')) ? 'active' : '' }}"
        >
            Gallery
        </a>
        <a
            href="{{ route('category.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : '' }}"
        >
            Categories
        </a>
        <a
            href="{{ route('user.index') }}"
            class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : '' }}"
        >
            Users
        </a>
        <a
            href="/index.html"
            class="list-group-item list-group-item-action"
        >
            Sign Out
        </a>
    </div>
</div>