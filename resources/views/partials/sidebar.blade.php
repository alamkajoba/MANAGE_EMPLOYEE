<ul style="background-color: rgb(16, 2, 66);" class="navbar-nav sidebar sidebar-dark accordion no-print" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-0">
                    <i class="fas fa-user-md"></i>
                </div>
                
            </a> --}}

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.dashboard')}}">
                    <i style="color:white;" class="fas fa-home"></i>
                    <span style="color:white;">Home/ 首页</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Agents/ 员工
            </div>

            {{--Employee--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
                    aria-expanded="true" aria-controls="collapseEmployee">
                    <i style="color:white;" class="fas fa-users"></i>
                    <span style="color:white;">Agents/ 员工</span> 
                </a>
                <div id="collapseEmployee" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('ListEmployee')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{ route('enrollment.index')}}">
                                List/ 员工名单
                            </a>
                        @endcan
                        @can('AddEmployee')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{ route('enrollment.create')}}">
                                Add/ 添加员工
                            </a>
                        @endcan
                        @can('ShowDisableEmployee')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{ route('enrollment.disable')}}">
                                Disables/ 离职/非活跃员工
                            </a>
                        @endcan
                        {{-- <hr style="color:rgb(16, 2, 66);"> --}}

                        @can('creer un membre de famille')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="">
                                Situation Famille/ 家庭情况
                            </a> 
                        @endcan

                        @can('PrintList')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('enrollment.printList')}}">
                                Print list/ 打印列表
                            </a> 
                        @endcan

                        @can('PrintAllDoc')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('enrollment.printAllDoc')}}">
                                Print all doc/ 打印所有文档
                            </a> 
                        @endcan
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifies"
                    aria-expanded="true" aria-controls="collapseNotifies">
                    <i style="color:white;" class="fa fa-envelope" aria-hidden="true"></i>
                    <span style="color:white;">Paiements</span> 
                </a>
                <div id="collapseNotifies" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(16, 2, 66);" class="collapse-item" href="">
                            Effectuer paiement
                        </a>
                        <a style="color:rgb(16, 2, 66);" class="collapse-item" href="">
                            Liste des paiements
                        </a>
                    </div>
                </div>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Manage/ 管理
            </div>

            {{--Documents--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRest"
                    aria-expanded="true" aria-controls="collapseRest">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">Rest doc/ 休假单</span> 
                </a>
                <div id="collapseRest" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('ListRest')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="#">
                                List/ 列表
                            </a>    
                        @endcan

                        @can('GiveRest')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="#">
                                Give rest/ 批准休假
                            </a>
                        @endcan
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEPI"
                    aria-expanded="true" aria-controls="collapseEPI">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">EPI/ 劳保用品发放</span> 
                </a>
                <div id="collapseEPI" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('ListEPI')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('epi.index')}}">
                                List/ 发放记录
                            </a>    
                        @endcan

                        @can('EecuteEPI')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('epi.execute')}}">
                                Execute/ 进行发放
                            </a>
                        @endcan

                        @can('CreateEPI')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('epi.create')}}">
                                Create/ 进行发放
                            </a>
                        @endcan
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Functions n Sites/ 岗位与站点
            </div>


            {{--Functions--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                    aria-expanded="true" aria-controls="collapseCategory">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">Functions/ 岗位列表</span> 
                </a>
                <div id="collapseCategory" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('ListFunction')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('function.index')}}">
                                List/ 添加岗位
                            </a>    
                        @endcan

                        @can('AddFunction')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('function.create')}}">
                                Add/ 站点
                            </a>
                        @endcan
                    </div>
                </div>
            </li>


            {{--Sites--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSites"
                    aria-expanded="true" aria-controls="collapseSites">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">Sites/ 站点</span> 
                </a>
                <div id="collapseSites" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('ListSite')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('site.index')}}">
                                List/ 站点列表
                            </a>    
                        @endcan

                        @can('AddSite')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('site.create')}}">
                                Add/ 添加站点
                            </a>
                        @endcan
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Users/ 用户
            </div>

            {{--Users--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser">
                    <i style="color:white;" class="fas fa-user"></i>
                    <span style="color:white">Users/ 用户管理</span> 
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @can('ListUser')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('user.index')}}">
                                List/ 用户列表
                            </a>
                        @endcan

                        @can('AddUser')
                            <a style="color:rgb(16, 2, 66);" class="collapse-item" href="{{route('user.create')}}">
                                Add/ 添加用户
                            </a>
                        @endcan
                    </div>
                </div>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>