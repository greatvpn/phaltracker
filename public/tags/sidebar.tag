<sidebar>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{opts.stdhead_data.user_info.avatar}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{opts.stdhead_data.user_info.name}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">导航</li>
                <li class="active treeview" each={opts.navigation}>
                    <a href="{url}">
                        <i class="fa fa-dashboard"></i> <span>{title}</span>
                        <span class="pull-right-container" if={children}>
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" if={children}>
                        <li each={children}><a href="{sub_url}"><i class="fa fa-circle-o"></i> {sub_title}</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</sidebar>