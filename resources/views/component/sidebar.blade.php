 <!-- Control Sidebar -->
 <aside class="control-sidebar">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{asset('images/index.jpeg')}}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center" style="color: #000;">{{usefullName()}}
            </h3>
            <p class="text-muted text-center">Software Engineer</p>
            <ul class="list-group list-group-unbordered mb-3 text-center">
              <li class="list-group-item bg-white">
                  <a href=""><i class="fa fa-lock">Mot de Passe</i></a>
              </li>
            
                <li class="list-group-item bg-white">
                    <a href=""><i class="fa fa-user pr-2">Mon Profil</i></a>
                </li>
            </ul>
            <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
               Deconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</aside>
