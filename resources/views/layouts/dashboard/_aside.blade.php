<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div>
      <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
      <p class="app-sidebar__user-designation">{{auth()->user()->email}}</p>
    </div>
  </div>
  <ul class="app-menu">

      <li><a class="app-menu__item  {{\Request::route()->getName() == 'admin' ? 'active' : ''}}" href="{{ route('welcome') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li>
            <a class="app-menu__item  {{\Request::route()->getName() == 'department.index' ? 'active' : ''}}" href="{{ route('department.index') }}">
                <i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Departments</span>
            </a>
        </li>

      <li>
          <a class="app-menu__item  {{\Request::route()->getName() == 'employee.index' ? 'active' : ''}}" href="{{ route('employee.index') }}">
              <i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Employees</span>
          </a>
      </li>

      <li>
          <a class="app-menu__item  {{\Request::route()->getName() == 'task.index' ? 'active' : ''}}" href="{{ route('task.index') }}">
              <i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Assign Task</span>
          </a>
      </li>

  </ul>
</aside>
