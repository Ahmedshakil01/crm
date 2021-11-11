<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
        $permission = Auth::guard('administration')->user();
    ?>
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/')}}assets/backend/admin/dist/img/logo.webp" alt="AleshaMart" class="brand-image">
        <span class="brand-text font-weight-light">AleshaMart Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="margin-bottom: 20px;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('/')}}assets/backend/admin/dist/img/admin.png" class="img-circle elevation-2" alt="Admin">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::guard('administration')->user()->fullname }}
                </a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                     <li class="nav-item">
                         <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Helper::menuIsActive([ 'admin.dashboard' ]) }}">
                             <i class="nav-icon fas fa-th"></i>
                             <p>Dashboard</p>
                         </a>
                     </li>

                    @if($permission->can('admin.view') || $permission->can('group.view') || $permission->can('roles.view') ||
                    $permission->can('permission.view') || $permission->can('notification.view') || $permission->can('support.view'))
                    <li class="sidenav-heading">Management Modules</li>
                    @endif

                    @if($permission->can('admin.create') || $permission->can('admin.view') || $permission->can('admin.edit') || $permission->can('admin.delete'))
                     <li class="nav-item {{ Helper::menuIsOpen([ 'admins.index', 'admins.create', 'admins.edit']) }} {{ Helper::menuIsActive([ 'admins.index', 'admins.create', 'admins.edit']) }}">
                         <a href="#" class="nav-link {{ Helper::menuIsActive(['admins.index', 'admins.create', 'admins.edit']) }}">
                             <i class="nav-icon fas fa-user-alt"></i>
                             <p>
                                 Admin
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'admins.index', 'admins.create', 'admins.edit']) }}">
                             @if($permission->can('admin.view'))
                                 <li class="nav-item">
                                     <a href="{{ route('admins.index')}}" class="nav-link {{ Helper::menuIsActive(['admins.index']) }}">
                                     <i class="fa fa-bars nav-icon"></i>
                                     <p>Admin List</p>
                                     </a>
                                 </li>
                             @endif
                             @if($permission->can('admin.create'))
                             <li class="nav-item">
                                 <a href="{{ route('admins.create')}}" class="nav-link {{ Helper::menuIsActive(['admins.create']) }}">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Admin</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif

                    @if($permission->can('roles.create') || $permission->can('roles.view') || $permission->can('roles.edit') || $permission->can('roles.delete'))
                     <li class="nav-item {{ Helper::menuIsOpen([ 'role.index', 'role.create', 'role.edit']) }} {{ Helper::menuIsActive([ 'role.index', 'role.create', 'role.edit']) }}">
                         <a href="#" class="nav-link {{ Helper::menuIsActive([ 'role.index', 'role.create', 'role.edit']) }}">
                           <i class="nav-icon fas fa-dice-d20"></i>
                           <p>
                             Role
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'role.index', 'role.create', 'role.edit']) }}">
                             @if($permission->can('roles.view'))
                             <li class="nav-item">
                                 <a href="{{ route('role.index')}}" class="nav-link {{ Helper::menuIsActive([ 'role.index']) }}">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Role List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('roles.create'))
                             <li class="nav-item">
                                 <a href="{{ route('role.create')}}" class="nav-link {{ Helper::menuIsActive([ 'role.create']) }}">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Role</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                    @if($permission->can('permission.create') || $permission->can('permission.view') || $permission->can('permission.edit') ||
                    $permission->can('permission.delete'))
                     <li class="nav-item {{ Helper::menuIsOpen([ 'permission.index', 'permission.create', 'permission.edit']) }} {{ Helper::menuIsActive([ 'permission.index', 'permission.create', 'permission.edit']) }}">
                         <a href="#" class="nav-link {{ Helper::menuIsActive([ 'permission.index', 'permission.create', 'permission.edit']) }}">
                           <i class="nav-icon fas fa-arrows-alt"></i>
                           <p>
                             Permission
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'permission.index', 'permission.create', 'permission.edit']) }}">
                             @if($permission->can('permission.view'))
                             <li class="nav-item">
                                 <a href="{{ route('permission.index')}}" class="nav-link {{ Helper::menuIsActive([ 'permission.index' ]) }}">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Permission List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('permission.create'))
                             <li class="nav-item">
                                 <a href="{{ route('permission.create')}}" class="nav-link {{ Helper::menuIsActive([ 'permission.create' ]) }}">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Permission</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                     @if($permission->can('group.create') || $permission->can('group.view') || $permission->can('group.edit') || $permission->can('group.delete'))
                     <li class="nav-item {{ Helper::menuIsOpen([ 'group.index', 'group.create', 'group.edit']) }} {{ Helper::menuIsActive([ 'group.index', 'group.create', 'group.edit']) }}">
                         <a href="#" class="nav-link {{ Helper::menuIsActive([ 'group.index', 'group.create', 'group.edit']) }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Permission Group
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'group.index', 'group.create', 'group.edit']) }}">
                             @if($permission->can('group.view'))
                             <li class="nav-item">
                                 <a href="{{ route('group.index')}}" class="nav-link {{ Helper::menuIsActive([ 'group.index']) }}">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Group List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('group.create'))
                             <li class="nav-item">
                                 <a href="{{ route('group.create')}}" class="nav-link {{ Helper::menuIsActive([ 'group.create']) }}">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Group</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif

                    {{-- Base Modules  --}}
                    @if($permission->can('customer.create') || $permission->can('customer.view') || $permission->can('customer.edit') || $permission->can('customer.delete'))
                    <li class="sidenav-heading">Base Modules</li>
                    <li class="nav-item {{ Helper::menuIsOpen([ 'customer.index', 'customer.create', 'admin.customer.details','customer.order.report']) }} {{ Helper::menuIsActive([ 'customer.index', 'customer.create','admin.customer.details','customer.order.report']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'customer.index', 'customer.create','admin.customer.details','customer.order.report']) }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customer
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'customer.index', 'customer.create','customer.order.report']) }}">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link {{ Helper::menuIsActive([ 'customer.index']) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('customer.create')}}" class="nav-link {{ Helper::menuIsActive(['customer.create']) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Customer</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.order.report')}}" class="nav-link {{ Helper::menuIsActive([ 'customer.order.report']) }}">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>Customer Order Report</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    <li class="nav-item {{ Helper::menuIsOpen([ 'lead.index', 'lead.create', 'admin.lead.details']) }} {{ Helper::menuIsActive([ 'lead.index', 'lead.create', 'admin.lead.details']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'lead.index', 'lead.create', 'admin.lead.details']) }}">
                        <i class="nav-icon fas fa-asterisk"></i>
                        <p>
                            Leads
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>

                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'lead.index', 'lead.create', 'admin.lead.details']) }}">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('lead.index')}}" class="nav-link {{ Helper::menuIsActive([ 'lead.index' ]) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Leads List</p>
                                </a>
                            </li>
                        @endif

                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('lead.create')}}" class="nav-link {{ Helper::menuIsActive([ 'lead.create' ]) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Leads</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    <li class="nav-item {{ Helper::menuIsOpen([ 'contact.index', 'contact.create', 'contact.edit']) }} {{ Helper::menuIsActive([ 'contact.index', 'contact.create', 'contact.edit']) }}">
                        <a href="{{ route('contact.index')}}" class="nav-link {{ Helper::menuIsActive([ 'contact.index', 'contact.create', 'contact.edit']) }}">
                        <i class="nav-icon fas fa-phone-square-alt"></i>
                        <p>
                            Contacts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'contact.index', 'contact.create', 'contact.edit']) }}">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('contact.index')}}" class="nav-link {{ Helper::menuIsActive([ 'contact.index' ]) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Contacts List</p>
                                </a>
                            </li>
                        @endif


                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('contact.create')}}" class="nav-link {{ Helper::menuIsActive([ 'contact.create' ]) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Contacts</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    @endif

                    {{-- Marketing Modules  --}}
                    <li class="sidenav-heading">Marketing Modules</li>
                    @if($permission->can('notification.create') || $permission->can('notification.view') || $permission->can('notification.edit') || $permission->can('notification.delete') || $permission->can('notification.type') || $permission->can('notification.userType'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'notification.index', 'admin.create.notification', 'admin.email-template.type', 'admin.email.template','admin.email-template.type.edit','admin.email-template.edit']) }} {{ Helper::menuIsActive([ 'notification.index', 'admin.create.notification', 'admin.email-template.type', 'admin.email.template','admin.email-template.type.edit','admin.email-template.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'notification.index', 'admin.create.notification', 'admin.email-template.type', 'admin.email.template','admin.email-template.type.edit','admin.email-template.edit']) }}">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>
                            Email Marketing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'notification.index', 'admin.create.notification', 'admin.email-template.type', 'admin.email.template','admin.email-template.type.edit','admin.email-template.edit']) }}">
                            @if($permission->can('notification.view'))
                            <li class="nav-item">
                                <a href="{{ route('notification.index')}}" class="nav-link {{ Helper::menuIsActive([ 'notification.index']) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Email List</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.create'))
                            <li class="nav-item">
                                <a href="{{ route('admin.create.notification')}}" class="nav-link {{ Helper::menuIsActive(['admin.create.notification']) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Send New Email</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('admin.email-template.type')}}" class="nav-link {{ Helper::menuIsActive(['admin.email-template.type']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Template Type</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('admin.email.template')}}" class="nav-link {{ Helper::menuIsActive(['admin.email.template']) }}">
                                <i class="fas fa-arrows-alt nav-icon"></i>
                                <p>Email Templates</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if($permission->can('notification.create') || $permission->can('notification.view') || $permission->can('notification.edit') ||
                    $permission->can('notification.delete') || $permission->can('notification.type') || $permission->can('notification.userType'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'sms-notification.index', 'admin.create.sms-notification', 'sms-notification.type','sms-notification.template','sms-notification.type.edit','sms-notification.template.edit']) }} {{ Helper::menuIsActive([ 'sms-notification.index', 'admin.create.sms-notification', 'sms-notification.type','sms-notification.template','sms-notification.type.edit','sms-notification.template.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'sms-notification.index', 'admin.create.sms-notification', 'sms-notification.type','sms-notification.template','sms-notification.type.edit','sms-notification.template.edit']) }}">
                        <i class="nav-icon fas fa-sms"></i>
                        <p>
                            SMS Marketing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'sms-notification.index', 'admin.create.sms-notification', 'sms-notification.type','sms-notification.template','sms-notification.type.edit','sms-notification.template.edit']) }}">
                            @if($permission->can('notification.view'))
                            <li class="nav-item">
                                <a href="{{ route('sms-notification.index')}}" class="nav-link {{ Helper::menuIsActive([ 'sms-notification.index']) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Sent SMS List</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.create'))
                            <li class="nav-item">
                                <a href="{{ route('admin.create.sms-notification')}}" class="nav-link {{ Helper::menuIsActive(['admin.create.sms-notification']) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Send New SMS</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('sms-notification.type')}}" class="nav-link {{ Helper::menuIsActive([ 'sms-notification.type']) }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Template Type</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('sms-notification.template')}}" class="nav-link {{ Helper::menuIsActive(['sms-notification.template']) }}">
                                <i class="fas fa-arrows-alt nav-icon"></i>
                                <p>SMS Templates</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if($permission->can('support.compose') || $permission->can('support.inbox') || $permission->can('support.sentmail') || $permission->can('support.draftmail'))
                     <li class="nav-item {{ Helper::menuIsOpen([ 'admin.newmail', 'admin.mailbox', 'admin.all-replies','admin.sentmail','admin.draftmail']) }} {{ Helper::menuIsActive([ 'admin.newmail', 'admin.mailbox', 'admin.all-replies','admin.sentmail','admin.draftmail']) }}">
                         <a href="#" class="nav-link {{ Helper::menuIsActive([ 'admin.newmail', 'admin.mailbox', 'admin.all-replies','admin.sentmail','admin.draftmail']) }}">
                           <i class="nav-icon fas fa-question-circle"></i>
                           <p>
                             Ticketing/Support
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'admin.newmail', 'admin.mailbox', 'admin.all-replies','admin.sentmail','admin.draftmail']) }}">
                             @if($permission->can('support.compose'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.newmail')}}" class="nav-link {{ Helper::menuIsActive([ 'admin.newmail']) }}">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>Create New Ticket</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.inbox'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.mailbox')}}" class="nav-link {{ Helper::menuIsActive([ 'admin.mailbox']) }}">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Ticket List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.inbox'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.all-replies')}}" class="nav-link {{ Helper::menuIsActive([ 'admin.all-replies']) }}">
                                    <i class="fa fa-reply-all" aria-hidden="true"></i>
                                 <p>Ticket Replies</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.sentmail'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.sentmail')}}" class="nav-link {{ Helper::menuIsActive([ 'admin.sentmail']) }}">
                                 <i class="far fa-paper-plane nav-icon"></i>
                                 <p>Sent Ticket list</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.draftmail'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.draftmail')}}" class="nav-link {{ Helper::menuIsActive([ 'admin.draftmail']) }}">
                                 <i class="far fa-envelope-open nav-icon"></i>
                                 <p>Draft Ticket list</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                    @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                   	 <li class="nav-item {{ Helper::menuIsOpen([ 'news.index', 'news.create', 'news.edit']) }} {{ Helper::menuIsActive([ 'news.index', 'news.create', 'news.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'news.index', 'news.create', 'news.edit']) }}">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            Social Posting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'news.index', 'news.create', 'news.edit']) }}">
                        @if($permission->can('news.view'))
                            <li class="nav-item">
                                <a href="{{ route('news.index')}}" class="nav-link {{ Helper::menuIsActive([ 'news.index']) }}">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Post List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('news.create'))
                            <li class="nav-item">
                                <a href="{{ route('news.create')}}" class="nav-link {{ Helper::menuIsActive([ 'news.create']) }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Post</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    @endif



                <li class="sidenav-heading">Sales Modules</li>
                <li class="nav-item {{ Helper::menuIsOpen([ 'campaign.index']) }} {{ Helper::menuIsActive([ 'campaign.index']) }}">
                    <a href="{{ route('campaign.index')}}" class="nav-link {{ Helper::menuIsActive([ 'campaign.index']) }}">
                        <i class="nav-icon fab fa-cuttlefish"></i>
                        <p>
                            Campaign List
                        </p>
                    </a>
                </li>

                <li class="sidenav-heading">Settings</li>

                @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'lead_sources.index', 'lead_sources.create', 'lead_sources.edit']) }} {{ Helper::menuIsActive([ 'lead_sources.index', 'lead_sources.create', 'lead_sources.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'lead_sources.index', 'lead_sources.create', 'lead_sources.edit']) }}">
                            <i class="nav-icon fas fa-caret-square-right"></i>
                            <p>
                                Leads Source
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'lead_sources.index', 'lead_sources.create', 'lead_sources.edit']) }}">
                            @if($permission->can('news.view'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_sources.index')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_sources.index']) }}">
                                        <i class="fa fa-bars nav-icon"></i>
                                        <p>Source List</p>
                                    </a>
                                </li>
                            @endif
                            @if($permission->can('news.create'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_sources.create')}}" class="nav-link {{ Helper::menuIsActive(['lead_sources.create']) }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>New Source</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'lead_status.index', 'lead_status.create', 'lead_status.edit']) }} {{ Helper::menuIsActive([ 'lead_status.index', 'lead_status.create', 'lead_status.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'lead_status.index', 'lead_status.create', 'lead_status.edit']) }}">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Leads Status
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'lead_status.index', 'lead_status.create', 'lead_status.edit']) }}">
                            @if($permission->can('news.view'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_status.index')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_status.index']) }}">
                                        <i class="fa fa-bars nav-icon"></i>
                                        <p>Status List</p>
                                    </a>
                                </li>
                            @endif
                            @if($permission->can('news.create'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_status.create')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_status.create']) }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>New Status</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'ticket_status.index', 'ticket_status.create', 'ticket_status.edit']) }} {{ Helper::menuIsActive([ 'ticket_status.index', 'ticket_status.create', 'ticket_status.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'ticket_status.index', 'ticket_status.create', 'ticket_status.edit']) }}">
                            <i class="nav-icon fas fa-caret-square-right"></i>
                            <p>
                                Ticket Status
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'ticket_status.index', 'ticket_status.create', 'ticket_status.edit']) }}">
                            @if($permission->can('news.view'))
                                <li class="nav-item">
                                    <a href="{{ route('ticket_status.index')}}" class="nav-link {{ Helper::menuIsActive([ 'ticket_status.index']) }}">
                                        <i class="fa fa-bars nav-icon"></i>
                                        <p>Status List</p>
                                    </a>
                                </li>
                            @endif
                            @if($permission->can('news.create'))
                                <li class="nav-item">
                                    <a href="{{ route('ticket_status.create')}}" class="nav-link {{ Helper::menuIsActive([ 'ticket_status.create']) }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>New Status</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'lead_industry.index', 'lead_industry.create', 'lead_industry.edit']) }} {{ Helper::menuIsActive([ 'lead_industry.index', 'lead_industry.create', 'lead_industry.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'lead_industry.index', 'lead_industry.create', 'lead_industry.edit']) }}">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                                Leads Industry
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'lead_industry.index', 'lead_industry.create', 'lead_industry.edit']) }}">
                            @if($permission->can('news.view'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_industry.index')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_industry.index']) }}">
                                        <i class="fa fa-bars nav-icon"></i>
                                        <p>Industry List</p>
                                    </a>
                                </li>
                            @endif
                            @if($permission->can('news.create'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_industry.create')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_industry.create']) }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>New Industry</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'lead_rating.index', 'lead_rating.create', 'lead_rating.edit']) }} {{ Helper::menuIsActive([ 'lead_rating.index', 'lead_rating.create', 'lead_rating.edit']) }}">
                        <a href="#" class="nav-link {{ Helper::menuIsActive([ 'lead_rating.index', 'lead_rating.create', 'lead_rating.edit']) }}">
                            <i class="nav-icon fas fa-caret-square-right"></i>
                            <p>
                                Leads Rating
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ Helper::menuIsActive([ 'lead_rating.index', 'lead_rating.create', 'lead_rating.edit']) }}">
                            @if($permission->can('news.view'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_rating.index')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_rating.index']) }}">
                                        <i class="fa fa-bars nav-icon"></i>
                                        <p>Rating List</p>
                                    </a>
                                </li>
                            @endif
                            @if($permission->can('news.create'))
                                <li class="nav-item">
                                    <a href="{{ route('lead_rating.create')}}" class="nav-link {{ Helper::menuIsActive([ 'lead_rating.create']) }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>New Rating</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($permission->can('sourceType.view'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'sourceType.index']) }} {{ Helper::menuIsActive([ 'sourceType.index']) }}">
                        <a href="{{ route('sourceType.index')}}" class="nav-link {{ Helper::menuIsActive([ 'sourceType.index']) }}">
                            <i class="fas fa-palette nav-icon"></i>
                            <p>Source Type</p>
                        </a>
                    </li>
                @endif

                @if($permission->can('comProfile.view') || $permission->can('comProfile.edit') || $permission->can('comProfile.delete'))
                    <li class="nav-item {{ Helper::menuIsOpen([ 'companyprofile.edit']) }} {{ Helper::menuIsActive([ 'companyprofile.edit']) }}">
                        <a href="{{ route('companyprofile.edit')}}" class="nav-link {{ Helper::menuIsActive([ 'companyprofile.edit']) }}">
                            <i class="fas fa-cogs nav-icon"></i>
                            <p>Website Settings</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
