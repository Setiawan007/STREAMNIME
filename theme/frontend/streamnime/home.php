<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= meta_tag([
        'title' => $websettings->seo_title,
        'description' => $websettings->seo_description,
        'favicon' => _storage($websettings->seo_favicon),
        'thumb' => _storage($websettings->seo_thumbnail),
        'keywords' => $websettings->seo_keywords,
        'url' => base_url(),
        'author' => ''
    ]); ?>
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>css/css23901.css?family=Sarabun:wght@300;400;700;800&amp;display=swap" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>css/line-awesome.min.css" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>vendor/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>vendor/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>css/style.default.css" id="theme-stylesheet" />
    <link rel="stylesheet" href="<?= _frontEnd($websettings->theme_active) ?>css/custom.css?v=11" />
    <style>
        @import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600");

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
        }

        .title-nimex {
            color: #fff;
            text-transform: uppercase;
            font-weight: 300;
            font-size: 20px;
            /* line-height: 42px; */
            margin: 0;
        }

        .hero {
            min-height: unset;
            background: url('https://wallpaperaccess.com/full/4864638.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        a {
            text-decoration: none;
        }

        .title-animex {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-size: 13px;
            color: #ffff;
        }

        .genre-oneline {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .card__cover {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            background-color: #222028;
        }

        .card__cover img {
            width: 100%;
            transition: opacity 0.5s;
        }

        .card__cover:hover img {
            opacity: 0.4;
        }

        .card__cover:hover .card__play {
            opacity: 1;
            transform: scale(1);
        }

        .card__play {
            position: absolute;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            margin: -30px 0 0 -30px;
            z-index: 3;
            font-size: 30px;
            color: #007df9;
            transition: 0.5s;
            transform: scale(0.9);
            transition-property: opacity, background-color, color, border-color, transform;
            opacity: 0;
            border: 6px solid rgba(255, 255, 255, 0.15);
        }

        .card__play i {
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #fff;
            padding: 1px 0 0 1px;
        }

        .card__play:hover {
            border-color: rgb(0 104 255 / 32%);
            color: #007df9;
        }

        .col-animex {
            padding-left: 5px;
            padding-right: 5px;
        }

        .box-eps {
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            position: absolute;
            z-index: 3;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 20px;
            bottom: 0px;
            background-color: rgb(0 0 0 / 71%);
            /* border: 2px solid transparent; */
            /* border-radius: 50%; */
        }

        .box-type {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            position: absolute;
            z-index: 3;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 1px 5px 3px 7px;
            top: 0px;
            right: 0px;
            background-color: rgb(0 0 0 / 50%);
            border-radius: 5%;
        }
    </style>
    <?= $webmaster->script_head ?>
</head>

<body>

    <?php require_once('include/header.php') ?>

    <!-- HERO SECTION -->
    <section class="hero py-1">
        <div id="particles-js"></div>
        <div class="container py-5 z-index-20 position-relative">
            <div class="row align-items-center mt-2">
                <div class="col">
                    <h1 class="text-light"><?= $custom_theme['title'] ?></h1>
                    <p class="text-light"><?= $custom_theme['description'] ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW ITEMS SECTION -->
    <section class="py-5">
        <div class="container-md px-0">
            <div class="row">
                <div class="col-12 col-xl-8 col-lg-8">
                    <div class="card rounded-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon icon-md me-2 flex-shrink-0 bg-primary rounded-sm text-white"><i class="las la-play"></i></div>
                                <h2 class="title-nimex">SEDANG TAYANG</h2>
                            </div>
                            <hr>
                            <div class="row">
                                <?php foreach ($neweps as $e) :
                                    $query = $this->db->query("SELECT * FROM anime_video WHERE id_anime=$e->id ORDER BY eps DESC LIMIT 1");
                                    if ($query->num_rows() != null) {
                                        $eps = $query->row();
                                ?>
                                        <div class="col-6 col-xl-3 col-lg-3 col-md-3 col-sm-4 mb-2 col-animex">
                                            <div class="card">
                                                <div class="card__cover">
                                                    <img class="card-img img-animex" src="<?= _storage("thumbnails/$e->thumb") ?>" alt="<?= $e->type_title ?>">
                                                    <a href="<?= ($eps->eps == 0) ? base_url("$e->seo_slug") : base_url("$e->seo_slug/$eps->eps") ?>" class="card__play">
                                                        <i class="las la-play"></i>
                                                    </a>
                                                    <span class="box-type"><?= $e->type_title ?></span>
                                                    <?= ($eps->eps == 0) ? '' : '<span class="box-eps">Episode ' . $eps->eps . '</span>' ?>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a class="title-animex" href="<?= ($eps->eps == 0) ? base_url("$e->seo_slug") : base_url("$e->seo_slug/$eps->eps") ?>"><?= $e->title ?></a>
                                            </div>
                                        </div>
                                <?php }
                                endforeach ?>
                            </div>
                            <div class="text-center mt-3">
                                <a class="btn btn-primary btn-sm" href="">View More</a>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon icon-md me-2 flex-shrink-0 bg-primary rounded-sm text-white"><i class="las la-play"></i></div>
                                <h2 class="title-nimex">Baru Ditambahkan</h2>
                            </div>
                            <hr>
                            <div class="row">
                                <?php foreach ($justadded as $news) : ?>
                                    <div class="col-6 col-xl-3 col-lg-3 col-md-3 col-sm-4 mb-2 col-animex">
                                        <div class="card">
                                            <div class="card__cover">
                                                <img class="card-img img-animex" src="<?= _storage("thumbnails/$news->thumb") ?>">
                                                <a href="<?= base_url("$news->seo_slug") ?>" class="card__play">
                                                    <i class="las la-play"></i>
                                                </a>
                                                <span class="box-type"><?= $news->type_title ?></span>
                                                <?= '<span class="box-eps">' . animextype($news->status) . '</span>' ?>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <a class="title-animex" href="<?= base_url("$news->seo_slug") ?>"><?= $news->title ?></a>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="text-center mt-3">
                                <a class="btn btn-primary btn-sm" href="<?= base_url("list?sort=baru") ?>">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded-0 mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon icon-md me-2 flex-shrink-0 bg-primary rounded-sm text-white"><i class="las la-play"></i></div>
                                <h2 class="title-nimex">TOP ANIME</h2>
                            </div>
                            <hr>
                            <?php foreach ($topnime as $news) : ?>
                                <div class="d-flex">
                                    <img style="height: 70px; margin-right: 10px;" src="<?= _storage("thumbnails/$news->thumb") ?>">
                                    <div class="">
                                        <a class="title-animex" href="<?= base_url("$news->seo_slug") ?>"><?= $news->title ?></a>
                                        <div class="genre-oneline">
                                            Genre :
                                            <?php foreach (explode(',', $news->genre) as $genretop) : ?>
                                                <a href="<?= base_url("list?genre=$genretop") ?>"><?= $genretop ?></a>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            Genre
                            <hr>
                            <?php foreach ($genres as $gs) : ?>
                                <a class="btn btn-sm btn-outline-primary rounded-0 mb-1" href="<?= base_url("list?genre=$gs->seo_slug") ?>"><?= $gs->title ?></a>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRELOADER -->
    <div class="preloader-outer">
        <div class="preloader-inner">
            <div class="loading"><span>Loading</span></div>
        </div>
    </div>

    <!-- SCROLL TO TOP BUTTON-->
    <div class="scroll-top-btn d-flex align-items-center shadow"><span>Top</span><i class="las la-arrow-right ms-2"></i></div>

    <?php require_once('include/footer.php') ?>

    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/particles.js/particles.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/choices.js/public/assets/scripts/choices.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/mixitup/mixitup.min.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/dropzone/dropzone.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>js/countdown.js"></script>
    <script>
        function compareViewports(jsonFile, jsonAltFile) {
            if (window.innerWidth > 768) {
                particlesJS.load("particles-js", `${jsonFile}`, function() {
                    console.log("particles is moving");
                });
            } else {
                particlesJS.load("particles-js", `${jsonAltFile}`, function() {
                    console.log("particles is moving");
                });
            }
        }
        compareViewports("<?= _frontEnd($websettings->theme_active) ?>particlejs/d2222d213f5e71a8a5d76e375d78ec00/raw/8693c75cae8cabaabec26eae4c5f0843a774760b/particles.json", "<?= _frontEnd($websettings->theme_active) ?>particlejs/6ff8987be59d53e491abdbccc1a34785/raw/d5d8f489d2eaa6e8169cfb563003665694f2ceb0/particles.mb.json");
    </script>
    <script src="<?= _frontEnd($websettings->theme_active) ?>js/theme.js"></script>
    <?= $webmaster->script_body ?>
</body>

</html>