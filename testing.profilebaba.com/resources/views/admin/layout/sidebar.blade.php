<ul class="sidebar-menu" id="nav-accordion">
    <li>
        <a class="" href="{{url('/admin/home')}}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php
        if($admin->role->id == 1){
            $menu = \App\AdminMenu::where('parent_id',0)->get();
        }
        else{
            $role_menu = \App\Permission::where('role_id',$admin->role->id)->get();
            $i=0;
            foreach($role_menu as $rm){
                $menu[ $rm->menu->parent->name][$i] = $rm->menu;
                $i++;
            }
        }
    ?>
    @if($admin->role->id == 1)
        @foreach ($menu as $data)
        <li class="sub-menu dcjq-parent-li">
            <a class="dcjq-parent" href="#">
                <i class="fa fa-tasks"></i>
                <span>{{$data->name}}</span>
                <span class="dcjq-icon"></span>
            </a>
            <ul class="sub" style="display: none;">
                <?php
                    $child_menu = $data->child;
                ?>
                @foreach ($child_menu as $val)
                @if($val->status != 0)
                <li><a href="{{url('/admin/'.$val->url)}}">{{$val->name}}</a></li>
                @endif
                @endforeach
            </ul>
        </li>
        @endforeach
    @else
        @foreach ($menu as $key => $data)
        <li class="sub-menu dcjq-parent-li">
            <a class="dcjq-parent" href="#">
                <i class="fa fa-tasks"></i>
                <span>{{$key}}</span>
                <span class="dcjq-icon"></span>
            </a>
            <ul class="sub" style="display: none;">
                @foreach ($data as $val)
                <li><a href="{{url('/admin/'.$val->url)}}">{{$val->name}}</a></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    @endif


</ul>
