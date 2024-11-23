<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
        Blogs
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('home') ? 'active':''}}  ">
            <a class="nav-link" href="{{url('home')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
        
          <!-- <li class="nav-item {{Request::is('posts') ? 'active':''}}">
            <a class="nav-link" href="{{url('posts')}}">
              <i class="material-icons">person</i>
              <p>Posts</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('comments') ? 'active':''}}">
            <a class="nav-link" href="{{url('comments')}}">
              <i class="material-icons">person</i>
              <p>Comments</p>
            </a>
          </li> -->
          <li class="nav-item {{Request::is('projects') ? 'active':''}}">
            <a class="nav-link" href="{{url('projects')}}">
              <i class="material-icons">person</i>
              <p>Projects</p>
            </a>
          </li>

          <li class="nav-item {{Request::is('tasks') ? 'active':''}}">
            <a class="nav-link" href="{{url('tasks')}}">
              <i class="material-icons">person</i>
              <p>Tasks</p>
            </a>
          </li>

          <li class="nav-item {{Request::is('incomes') ? 'active':''}}">
            <a class="nav-link" href="{{url('incomes')}}">
              <i class="material-icons">person</i>
              <p>Incomes</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('budgets') ? 'active':''}}">
            <a class="nav-link" href="{{url('budgets')}}">
              <i class="material-icons">person</i>
              <p>Budgets</p>
            </a>
          </li>
         
        
        
        </ul>
      </div>
    </div>