<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <!-- Navbar Brand -->
        <a class="navbar-brand" href="<?= base_url() ?>"><img style="width: 40px;" src="<?= _storage($websettings->site_logo) ?>" alt="CR" width="140" /></a>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-lg-row align-items-lg-center">
                <?php
                foreach ($menus as $m) :
                    if ($m->type == 'direct') {
                        echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="' . base_url($m->link) . '">' . $m->title . '</a></li>';
                    } else if ($m->type == 'dropdown') {
                        echo '<li class="nav-item dropdown">';
                        echo '<a class="nav-link dropdown-toggle" id="exploreDropdown" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $m->title . '</a>';
                        echo '<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end fade-down" aria-labelledby="exploreDropdown">';
                        $sub = $this->db->get_where('site_menus', ['type' => 'submenu', 'sub_id' => $m->id])->result();
                        foreach ($sub as $s) {
                            echo '<li><a class="dropdown-item" href="' . base_url($s->link) . '">' . $s->title . '</a></li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    }
                endforeach
                ?>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-gradient-primary btn-sm px-3 d-lg-flex align-items-center" href="#"> Tonton Nanti</a>
                </li>
            </ul>
        </div>

    </div>
</nav>