<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billocity</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"
  ></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />




{{-- To --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



<style>
/* .hid{
  display: block;
} */
@media only screen and (max-width: 600px){
  .hid{
    display: none !important;
  }
}
</style>

  </head>
  <body>
    <header id="header">
      <div class="header-left">
        <div>
          <a href="/"><h2 class="o-logo">Billocity</h2></a>
        </div>
        
        <div class="left-menu">
          <i id="left-ham" class="fas fa-bars"></i>
          {{-- <img id="gift" src="{{asset('images/gift.svg')}}" alt="" /> --}}
        </div>
      </div>
      <div class="header-right ">
        <div class="user-det hid">
          {{-- <img
            src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png"
            alt=""
          /> --}}
          <div class="dets">
            @auth
              <p id="n">{{Auth::user()->name}}</p>
              <p>{{Auth::user()->role}}</p>
            @endauth
          </div>
          <div style="width: 30px">

          </div>
          <div class="dets ml-4">
            <a href="https://oswinjerome.in" target="__blank"><p id="n">XYZ Softwares</p></a>
            <p>V 1.0</p>
          </div>
        </div>
        {{-- <p class="m-0">POS</p> --}}
        <a href="/pos" target="__blank" class="m-0">POS</a>
      </div>
    </header>

    <main>
      <aside class="left-drawer">
        <p class="nav-title ">MENU</p>
        <ul>
          <li>
            <a href="/" class="o-head"><i class="fas fa-tachometer-alt">
            </i> <span>Dashboard</span></a>
          </li>
          {{-- <li class="has-sub">
            <a class="o-head"><i class="fas fa-tachometer-alt">
                </i> <span>Dashboard</span></a>
            <ul class="inul">
              <li><a href="">Analytisc</a></li>
              <li><a href="">Sales </a></li>
            </ul>
          </li> --}}
          {{-- Brands --}}
          @if (Auth::user()->role=="admin")
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-users"></i><span>Users</span>
            </a>
            <ul class="inul">
              <li><a href="/users/create">Add Users</a></li>
              <li><a href="/users">View Users</a></li>
            </ul>
          </li>
          @endif
          
          {{-- Brands --}}
          <li class="has-sub">
            <a class="o-head">
                <i class="fab fa-buysellads"></i><span>Brands</span>
            </a>
            <ul class="inul">
              <li><a href="/brands/create">Add Brand</a></li>
              <li><a href="/brands">View Brands</a></li>
            </ul>
          </li>

          {{-- Categories --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-list"></i><span>Categories</span>
            </a>
            <ul class="inul">
              <li><a href="/categories/create">Add Category</a></li>
              <li><a href="/categories">View Categories</a></li>
            </ul>
          </li>

          {{-- Products --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-shopping-cart"></i><span>Products</span>
            </a>
            <ul class="inul">
              <li><a href="/products/create">Add Products</a></li>
              <li><a href="/products">View Products</a></li>
              <li><a href="/prods/stockin">Stock IN</a></li>
            </ul>
          </li>

          {{-- Customers --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-users"></i><span>Customers</span>
            </a>
            <ul class="inul">
              <li><a href="/customers/create">Add Customer</a></li>
              <li><a href="/customers">View Customers</a></li>
            </ul>
          </li>

          {{-- Suppliers --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-users"></i><span>Suppliers</span>
            </a>
            <ul class="inul">
              <li><a href="/suppliers/create">Add Supplier</a></li>
              <li><a href="/suppliers">View Suppliers</a></li>
            </ul>
          </li>

          {{-- Sales --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-cart-plus"></i><span>Sales</span>
            </a>
            <ul class="inul">
              <li><a href="/invoices">View Sales</a></li>
              <li><a href="/pending_customer_payment">View Pending payment</a></li>
              <li><a href="/prods/returned">View Returned Products</a></li>
            </ul>
          </li>

          {{-- Expenses --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-money-check-alt"></i><span>Expenses</span>
            </a>
            <ul class="inul">
              <li><a href="/expenses/create">Add Expenses</a></li>
              <li><a href="/expenses">View Expenses</a></li>
              <li><a href="/expense-categories/create">Add Expense Category</a></li>
              <li><a href="/expense-categories">View Expense Category</a></li>

            </ul>
          </li>


          {{-- Report --}}
          <li class="has-sub">
            <a class="o-head">
              <i class="fas fa-clipboard"></i><span>Report</span>
            </a>
            <ul class="inul">
              {{-- <li><a href="/invoices">Sales Report</a></li> --}}
              <li><a href="/reports/stock">Stock Report</a></li>
              <li><a href="/reports/stockin">Stock IN Report</a></li>
              <li><a href="/reports/sales">Sales Report</a></li>
              <li><a href="/reports/expense">Expense Report</a></li>
              <li><a href="/reports/c_credit">Customer Credit</a></li>
              <li><a href="/reports/s_debit">Supplier Debit</a></li>
            </ul>
          </li>

        </ul>
      </aside>
      <section id="contents">
          @yield('content')
      </section>
    </main>
  </body>
 
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! \Toastr::message() !!}


  <script>

    var navMinimized = window.localStorage.getItem('minz');
    if(navMinimized=="true"){
    console.log(navMinimized)
      $('.left-drawer').toggleClass('closed-state')
    }
    $(document).ready(() => {
      $(".has-sub").click(function () {
        
        // Close all drops
        $(".has-sub")
          .not(this)
          .each(function () {
            $(this).removeClass("tap");
            if (!$(this).hasClass("tap")) {
              $(this).children("ul").slideUp(300);
            } else {
              $(this).children("ul").slideDown(300);
            }
          });

        //   open current drop
        $(this).toggleClass("tap");
        if (!$(this).hasClass("tap")) {
          $(this).children("ul").slideUp(300);
        } else {
          $(this).children("ul").slideDown(300);
        }
      });
    });




    // Left ham
    $('#left-ham').on('click',function(){
        $('.left-drawer').toggleClass('closed-state')
        if($('.left-drawer').hasClass('closed-state')){
            navMinimized = true;
            window.localStorage.setItem("minz", true);

        }else{
            navMinimized = false;
            window.localStorage.setItem("minz", false);

        }
    })

    // Open on hover
    $('.left-drawer').hover(function(){
        if(navMinimized=='true'){
            $('.left-drawer').toggleClass('closed-state')

        }
    })
  </script>
</html>
