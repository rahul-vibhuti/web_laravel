 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item nav-profile">
             <a href="#" class="nav-link">
                 <div class="nav-profile-image">
                     @if(File::exists(public_path(Auth::user()->image)))
                     <img src="{{ asset(Auth::user()->image) }}" alt="profile">
                     @else

                     <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                     @endif
                     <span class="login-status online"></span>
                     <!--change to offline or busy as needed-->
                 </div>
                 <div class="nav-profile-text d-flex flex-column">
                     <span class="font-weight-bold mb-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                     </span>
                     <span class="text-secondary text-small">{{ Auth::user()->bio }}</span>
                 </div>
                 <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
             </a>
         </li>
         <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ?'active':'' }}">
             <a class="nav-link" href="{{ route('dashboard') }}">
                 <span class="menu-title">Dashboard</span>
                 <i class="mdi mdi-home menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'categories.') ? 'active' : '' }} {{ Str::startsWith(Route::currentRouteName(), 'subcategories.') ? 'active' : '' }}">
             <a class="nav-link " data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <span class="menu-title">Manage Category</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-format-list-bulleted menu-icon"></i>
             </a>
             <div class="collapse" id="ui-basic">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'categories.') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                     </li>
                     <li class="nav-item"> <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'subcategories.') ? 'active' : '' }}" href="{{ route('subcategories.index') }}">Sub-Categories</a></li>
                 </ul>
             </div>
         </li>
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'clients.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('clients.index') }}">
                 <span class="menu-title">Customers</span>
                 <i class="mdi mdi-account-multiple menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'portfolios.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('portfolios.index') }}">
                 <span class="menu-title">Portfolio </span>
                 <i class="mdi mdi-contacts menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'reviews.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('reviews.index') }}">
                 <span class="menu-title">Reviews</span>
                 <i class="mdi mdi-format-list-bulleted menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'stories.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('stories.index') }}">
                 <span class="menu-title">stories</span>
                 <!-- <i class="mdi mdi-chart-bar menu-icon"></i> -->
                 <i class="mdi mdi-database menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'meta.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('meta.index') }}">
                 <span class="menu-title">Meta Data</span>
                 <i class="mdi mdi-table-large menu-icon"></i>
             </a>
         </li>
         <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'team.') ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('team.index') }}">
                 <span class="menu-title">My Team</span>
                 <i class="mdi mdi-account-multiple-outline menu-icon"></i>
             </a>
         </li>
      

         <!-- <li class="nav-item sidebar-actions">
             <span class="nav-link">
                 <div class="border-bottom">
                     <h6 class="font-weight-normal mb-3">Projects</h6>
                 </div>
                 <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                 <div class="mt-4">

                 </div>
             </span>
         </li> -->
     </ul>
 </nav>