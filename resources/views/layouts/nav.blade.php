<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4 pt-5">
        <h1><a href="{{ route('home') }}" class="logo">CRM-3539</a></h1>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="{{ route('categories.index') }}">Categories</a>
            </li>
            <li>
                <a href="{{ route('shops.index') }}">Shops</a>
            </li>
        </ul>

        <div class="footer">
            <p>
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                All rights reserved | This template is made by
                <b><a style="color: #fff" target="_blank" href="https://github.com/AliverdiSultanli">Aliverdi Sultanli</a></b>
            </p>
        </div>
    </div>
</nav>
