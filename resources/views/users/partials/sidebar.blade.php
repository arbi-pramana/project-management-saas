<div class="deznav">
    <div class="deznav-scroll">
        <!-- <a href="javascript:void(0)" class="add-menu-sidebar" data-toggle="modal" data-target="#addOrderModalside" >+ New Event</a> -->
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('users.dashboard.executive')}}">Executive Dashboard</a></li>
                    <li><a href="{{route('users.dashboard.resources')}}">Resource Dashboard</a></li>
                </ul>
            </li>
            <li><a href="{{route('users.project.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-archive"></i>
                    <span class="nav-text">Projects</span>
                </a>
            </li>
            <li><a href="{{route('users.client.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-user-8"></i>
                    <span class="nav-text">Clients</span>
                </a>
            </li>
            <li><a href="{{route('users.plan.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-bookmark"></i>
                    <span class="nav-text">Plan</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Data Master</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('users.employee.index')}}">Employee</a></li>
                    <li><a href="{{route('users.employee-type.index')}}">Employee Type</a></li>
                    <li><a href="{{route('users.department.index')}}">Department</a></li>
                </ul>
            </li>
        </ul>
        <!-- <div class="copyright" style="position: absolute;bottom: 0;">
            <p><strong>Acara Ticketing Dashboard</strong> © 2021 All Rights Reserved</p>
            <p>Made with <span class="heart"></span> by DexignZone</p>
        </div> -->
    </div>
</div>