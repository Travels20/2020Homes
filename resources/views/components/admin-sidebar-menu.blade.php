<li class="sidebar-nav-item">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link {{ request()->is('admin') || request()->is('admin/') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 sidebar-nav-icon"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Properties with Submenu -->
<li class="sidebar-nav-item">
    <a href="#propertySubmenu" class="sidebar-nav-link {{ request()->is('admin/properties*') || request()->is('admin/my-properties*') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="{{ request()->is('admin/properties*') || request()->is('admin/my-properties*') ? 'true' : 'false' }}" aria-controls="propertySubmenu">
        <i class="bi bi-building sidebar-nav-icon"></i>
        <span>Properties</span>
        <i class="bi bi-chevron-down ms-auto sidebar-nav-icon"></i>
    </a>
    <div class="collapse {{ request()->is('admin/properties*') || request()->is('admin/my-properties*') ? 'show' : '' }}" id="propertySubmenu">
        <ul class="sidebar-nav-submenu list-unstyled">
            @php
                $isAdmin = in_array(auth()->user()->role ?? null, ['admin', 'superadmin'], true);
            @endphp
            <li>
                <a href="{{ $isAdmin ? route('admin.properties.index') : route('admin.my-properties') }}" class="sidebar-nav-link ps-5">
                    <i class="bi bi-list-ul sidebar-nav-icon"></i>
                    <span>{{ $isAdmin ? 'All Properties' : 'My Properties' }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.properties.create') }}" class="sidebar-nav-link ps-5 {{ request()->is('admin/properties/create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle sidebar-nav-icon"></i>
                    <span>Add Property</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Enquiries -->
<li class="sidebar-nav-item">
    <a href="#enquirySubmenu" class="sidebar-nav-link {{ request()->is('admin/enquiries*') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="{{ request()->is('admin/enquiries*') ? 'true' : 'false' }}" aria-controls="enquirySubmenu">
        <i class="bi bi-chat-dots sidebar-nav-icon"></i>
        <span>Enquiries</span>
        <i class="bi bi-chevron-down ms-auto sidebar-nav-icon"></i>
    </a>
    <div class="collapse {{ request()->is('admin/enquiries*') ? 'show' : '' }}" id="enquirySubmenu">
        <ul class="sidebar-nav-submenu list-unstyled">
            <li>
                <a href="{{ route('admin.enquiries.index') }}" class="sidebar-nav-link ps-5 {{ request()->is('admin/enquiries') ? 'active' : '' }}">
                    <i class="bi bi-list-ul sidebar-nav-icon"></i>
                    <span>All Enquiries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.enquiries.walk-in') }}" class="sidebar-nav-link ps-5 {{ request()->is('admin/enquiries/walk-in') ? 'active' : '' }}">
                    <i class="bi bi-person-add sidebar-nav-icon"></i>
                    <span>Walk-in Enquiry</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Users -->
<li class="sidebar-nav-item">
    <a href="{{ route('admin.users.index') }}" class="sidebar-nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
        <i class="bi bi-people sidebar-nav-icon"></i>
        <span>Users</span>
    </a>
</li>

<!-- Site Settings -->
<li class="sidebar-nav-item">
    <a href="{{ route('admin.settings.index') }}" class="sidebar-nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
        <i class="bi bi-gear sidebar-nav-icon"></i>
        <span>Site Settings</span>
    </a>
</li>
