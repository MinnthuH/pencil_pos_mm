<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span> Home </span>
                    </a>
                </li>
                @if (Auth::user()->can('admin.manage'))
                    <li>
                        <a href="{{ route('admin.manage') }}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->can('pos.menu'))
                    <li>
                        <a href="{{ route('pos') }}">
                            <span class="badge bg-pink float-end">Hot</span>
                            <i class="fas fa-cash-register"></i>
                            <span> ကောင်တာ </span>
                        </a>
                    </li>
                @endif



                <li class="menu-title mt-2">Apps</li>
                {{-- @if (Auth::user()->can('employee.menu'))
                    <li>
                        <a href="#employee" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span> Employee Manage</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="employee">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('employee.all'))
                                    <li>
                                        <a href="{{ route('all#employee') }}">All Employee</a>
                                    </li>
                                @endif

                                @if (Auth::user()->can('employee.add'))
                                    <li>
                                        <a href="{{ route('add#employee') }}">Add Employee</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif --}}

                @if (Auth::user()->can('customer.menu'))
                    <li class="my-1">
                        <a href="#customer" data-bs-toggle="collapse">
                            <i class="fas fa-users"></i>
                            <span> ဖေါက်သည် စီမံခန့်ခွဲခြင်း</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="customer">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('customer.all'))
                                    <li>
                                        <a href="{{ route('all#customer') }}">ဖေါက်သည် စာရင်းများ</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('customer.add'))
                                    <li>
                                        <a href="{{ route('add#customer') }}">ဖေါက်သည် အသစ်ထည့်ရန်</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('supplier.menu'))
                    <li class="my-1">
                        <a href="#salary" data-bs-toggle="collapse">
                            <i class="fas fa-truck"></i>
                            <span> တင်သွင်းသူ စီမံခန့်ခွဲခြင်း </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="salary">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('supplier.all'))
                                    <li>
                                        <a href="{{ route('all#supplier') }}">တင်သွင်းသူ စာရင်းများ</a>
                                    </li>
                                @endif

                                @if (Auth::user()->can('supplier.add'))
                                    <li>
                                        <a href="{{ route('add#supplier') }}">တင်သွင်းသူအသစ်ထည့်ရန်</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </li>
                @endif


                {{-- @if (Auth::user()->can('salary.menu'))
                    <li>
                        <a href="#employeeSalary" data-bs-toggle="collapse">
                            <i class="fas fa-money-bill-wave"></i>
                            <span> Employee Salary </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="employeeSalary">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('salary.all'))
                                    <li>
                                        <a href="{{ route('all#advSalary') }}">All Advance Salary</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('add.advance'))
                                    <li>
                                        <a href="{{ route('add#advSalary') }}">Add Advance Salary</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('salary.pay'))
                                    <li>
                                        <a href="{{ route('pay#Salary') }}">Pay Salary</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('salary.paid'))
                                    <li>
                                        <a href="{{ route('month#Salary') }}">Last Month Salary</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif --}}

                {{-- @if (Auth::user()->can('attendence.menu'))
                    <li>
                        <a href="#attendance" data-bs-toggle="collapse">
                            <i class="fas fa-clock"></i>
                            <span> Employee Attendance </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="attendance">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('add#attendance') }}">Add Employee Attendance</a>
                                </li>
                                <li>
                                    <a href="{{ route('employee#attendance') }}">Employee Attendance List</a>
                                </li>


                            </ul>
                        </div>
                    </li>
                @endif --}}
                @if (Auth::user()->can('category.menu'))
                    <li class="my-1">
                        <a href="#category" data-bs-toggle="collapse">
                            <i class="fas fa-box"></i>
                            <span> အမျိုးအစား စီမံခန့်ခွဲခြင်း </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="category">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all#category') }}">အမျိုးအစား စာရင်းများ</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('product.menu'))
                    <li>
                        <a href="#products" data-bs-toggle="collapse">
                            <i class="fas fa-boxes"></i>
                            <span> ကုန်ပစ္စည်း စီမံခန့်ခွဲခြင်း </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="products">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('product.all'))
                                    <li>
                                        <a href="{{ route('all#product') }}">ကုန်ပစ္စည်း စာရင်းများ</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('prodcut.add'))
                                    <li>
                                        <a href="{{ route('add#product') }}">ကုန်ပစ္စည်း အသစ်ထည့်ရန်</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('product.import'))
                                    <li>
                                        <a href="{{ route('import#product') }}">ကုန်ပစ္စည်း ဖိုင်ဖြင့်သွင်းရန်</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </li>
                @endif
                {{-- @if (Auth::user()->can('order.menu'))
                    <li>
                        <a href="#orders" data-bs-toggle="collapse">
                            <i class="fas fa-clipboard"></i>
                            <span> orders </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="orders">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('pending#order') }}">Pending Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('complete#order') }}">Complete Order</a>
                                </li>

                                <li>
                                    <a href="{{ route('pending#due') }}">Pending Due</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif --}}
                <li class="my-1">
                    <a href="#sales" data-bs-toggle="collapse">
                        <i class=" fas fa-hand-holding-usd"></i>
                        <span> အရောင်းစာရင်း </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sales">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all#sale') }}">အရောင်းစာရင်းများ</a>
                            </li>
                            <li>
                                <a href="{{ route('pending.due') }}">ကြွေးကျန်စာရင်းများ</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="my-1">
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class=" fas fa-book-open"></i>
                        <span> ကုန်ပစ္စည်းစာရင်း </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('manage#stock') }}">ကုန်ပစ္စည်းလက်ကျန်စာရင်း</a>
                            </li>
                            <li>
                                <a href="{{ route('noti.stock') }}">သတိပေးပစ္စည်းစာရင်း</a>
                            </li>
                            <li>
                                <a href="{{ route('noti.expire') }}">Expired သတိပေး</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->can('role&permission.menu'))
                    <li class="my-1">
                        <a href="#permission" data-bs-toggle="collapse">
                            <i class="fas fa-user-shield"></i>
                            <span> Role & Permission </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="permission">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('all#permission') }}">All Permission</a>
                                </li>
                                <li>
                                    <a href="{{ route('all#roles') }}">All Roles</a>
                                </li>
                                <li>
                                    <a href="{{ route('add#rolepermission') }}">Roles In Permission</a>
                                </li>
                                <li>
                                    <a href="{{ route('all#rolepermission') }}">All Roles In Permission</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('role&permission.menu'))
                    <li class="my-1">
                        <a href="#admin" data-bs-toggle="collapse">
                            <i class="fas fa-user-cog"></i>
                            <span> Setting Admin User </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="admin">
                            <ul class="nav-second-level">
                                @if (Auth::user()->can('admin.all'))
                                    <li>
                                        <a href="{{ route('all#admin') }}">All Admin</a>
                                    </li>
                                @endif
                                @if (Auth::user()->can('admin.add'))
                                    <li>
                                        <a href="{{ route('all#roles') }}">Add Role</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </li>
                @endif



                <li class="menu-title mt-2">Custom</li>

                <li class="my-1">
                    <a href="#addexpense" data-bs-toggle="collapse">
                        <i class="fas fa-coins"></i>
                        <span> အသုံးစာရင်း </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="addexpense">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add#expense') }}">အသုံးစာရင်း ထည့်သွင်းခြင်း</a>
                            </li>
                            <li>
                                <a href="{{ route('today#expense') }}">ယနေ့အသုံးစာရင်း</a>
                            </li>
                            <li>
                                <a href="{{ route('month#expense') }}">လစဉ်အသုံးစာရင်း</a>
                            </li>
                            <li>
                                <a href="{{ route('year#expense') }}">နှစ်စဉ် အသုံးစာရင်း</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (Auth::user()->can('admin.manage'))
                    <li class="my-1">
                        <a href="#shopinfo" data-bs-toggle="collapse">
                            <i class="fas fa-coins"></i>
                            <span> ဆိုင်အချက်အလက် </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="shopinfo">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('shop#info') }}">Shop info </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                {{-- @if (Auth::user()->can('admin.manage'))
                    <li class="my-1">
                        <a href="#backup" data-bs-toggle="collapse">
                            <i class="fas fa-cloud-download-alt"></i>
                            <span>Database Backup </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="backup">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('backup#database') }}">Database Backup</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif --}}


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
