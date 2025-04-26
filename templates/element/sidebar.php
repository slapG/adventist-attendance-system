<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                <a href="index.html"><img src="<?= $this->Url->assetUrl('img/logo.png') ?>" alt="Logo" style="height: 70px; width: 190px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-bounding-box"></i>
                        <span>Attendance</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?= $this->Url->build(['controller' => 'employees', 'action' => 'index']) ?>" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                </li>

                <li class="sidebar-title">Configurations</li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>User</span>
                    </a>
                </li>                        

                <li class="sidebar-title">Raise Support For Nikks</li>

                <li class="sidebar-item  ">
                    <a href="https://zuramai.github.io/mazer/docs" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>Gcash</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md" class='sidebar-link'>
                        <i class="bi bi-puzzle"></i>
                        <span>BDO</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="https://github.com/zuramai/mazer#donate" class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Donate</span>
                    </a>
                </li>

                <li class="sidebar-title">User Comand</li>

                <li class="sidebar-item  ">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>