<ul class="vertical-nav-menu" style="overflow-y: auto; height:100vh; padding-bottom:60px;">
    <li class="app-sidebar__heading">Dashboards</li>
    <li>
        <a href="/" class="mm-active">
            <i class="metismenu-icon pe-7s-rocket"></i>
            Dashboard
        </a>
    </li>
    <li class="app-sidebar__heading">Menus</li>
    @if (Auth::user()->role=="admin")
        <li>
            <a href="#">
                <i class="metismenu-icon pe-7s-users"></i>
                Users
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
            </a>
            <ul>
                <li><a href="/users/create">Add Users</a></li>
                <li><a href="/users">View Users</a></li>
            </ul>
        </li>
     @endif
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-ticket"></i>
            Brands
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/brands/create">Add Brand</a></li>
            <li><a href="/brands">View Brands</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-menu"></i>
            Categories
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/categories/create">Add Category</a></li>
            <li><a href="/categories">View Categories</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-plugin"></i>
            Products
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/products/create">Add Products</a></li>
            <li><a href="/products">View Products</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-users"></i>
            Customers
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/customers/create">Add Customer</a></li>
            <li><a href="/customers">View Customers</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-user"></i>
            Suppliers
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/suppliers/create">Add Supplier</a></li>
            <li><a href="/suppliers">View Suppliers</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-news-paper"></i>
            Sales
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/invoices">View Sales</a></li>
            <li><a href="/pending_customer_payment">View Pending payment</a></li>
            <li><a href="/prods/returned">View Returned Products</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-cart"></i>
            Purchase
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/purchases/create">Add Pruchase</a></li>
            <li><a href="/purchases">View Purchase</a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-plugin"></i>
            EMI Manager
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/emi/create">Add emi</a></li>
            <li><a href="/emi">View emi</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-cash"></i>
            Expenses
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/expenses/create">Add Expenses</a></li>
            <li><a href="/expenses">View Expenses</a></li>
            <li><a href="/expense-categories/create">Add Expense Category</a></li>
            <li><a href="/expense-categories">View Expense Category</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-diamond"></i>
            Barcode
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/barcode">Generate</a></li>
            <li><a href="/barcode-with-product">Generate from product</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-note2"></i>
            Reports
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li><a href="/reports/emi">Emi Report</a></li>
            <li><a href="/reports/emi_pay">Emi Payment Report</a></li>
            <li><a href="/reports/stock">Stock Report</a></li>
            <li><a href="/reports/stockin">Stock IN Report</a></li>
            <li><a href="/reports/stock_out">Stock Out Report</a></li>
            <li><a href="/reports/sales">Sales Report</a></li>
            <li><a href="/reports/expense">Expense Report</a></li>
            <li><a href="/reports/c_credit">Customer Credit</a></li>
            <li><a href="/reports/s_debit">Supplier Debit</a></li>
        </ul>
    </li>
   
    {{-- <li>
        <a href="tables-regular.html">
            <i class="metismenu-icon pe-7s-display2"></i>
            Tables
        </a>
    </li> --}}
    
</ul>