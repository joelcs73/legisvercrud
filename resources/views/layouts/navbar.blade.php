<div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler nav-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              Menu
              <i class="fa fa-bars"></i>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                <a class="nav-link " href="index.php?p=inicio"><span class="fa fa-home fa-2x"></span></a>
                </li>
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Opciones de usuario
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach ($menu as $item)
                    <a class="dropdown-item" id="{{ $item->idDiv }}" href="/{{ $item->paginaHref }}">{{ $item->tituloMenu }}</a>
                @endforeach
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    </div>
    </div>