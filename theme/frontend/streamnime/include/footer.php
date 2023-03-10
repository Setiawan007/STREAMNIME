<footer class="footer bg-map bg-dark">
    <div class="container py-2 z-index-20 text-center">
        <div class="mt-2">
            <?= ($websettings->social_facebook != '#') ? '<span><a class="text-light" href="' . $websettings->social_facebook . '" data-bs-toggle="Facebook" data-bs-placement="bottom" title="Facebook"><i class="lab la-facebook-f"></i></a></span>' : '' ?>
            <?= ($websettings->social_twitter != '#') ? '<span><a class="text-light" href="' . $websettings->social_twitter . '" data-bs-toggle="Twitter" data-bs-placement="bottom" title="Twitter"><i class="lab la-twitter"></i></a></span>' : '' ?>
            <?= ($websettings->social_linkedin != '#') ? '<span><a class="text-light" href="' . $websettings->social_linkedin . '" data-bs-toggle="Linkedin" data-bs-placement="bottom" title="Linkedin"><i class="lab la-linkedin-in"></i></a></span>' : '' ?>
            <?= ($websettings->social_instagram != '#') ? '<span><a class="text-light" href="' . $websettings->social_instagram . '" data-bs-toggle="Instagram" data-bs-placement="bottom" title="Instagram"><i class="lab la-instagram"></i></a></span>' : '' ?>
            <?= ($websettings->social_whatsapp != '#') ? '<span><a class="text-light" href="' . $websettings->social_whatsapp . '" data-bs-toggle="Whatsapp" data-bs-placement="bottom" title="Whatsapp"><i class="lab la-whatsapp"></i></a></span>' : '' ?>
            <?= ($websettings->social_youtube != '#') ? '<span><a class="text-light" href="' . $websettings->social_youtube . '" data-bs-toggle="Youtube" data-bs-placement="bottom" title="Youtube"><i class="lab la-youtube"></i></a></span>' : '' ?>
            <?= ($websettings->social_github != '#') ? '<span><a class="text-light" href="' . $websettings->social_github . '" data-bs-toggle="Github" data-bs-placement="bottom" title="Github"><i class="lab la-github"></i></a></span>' : '' ?>
        </div>
        <small>Penafian: Situs ini <?= $custom_theme['title'] ?> tidak menyimpan file anime apapun di server. Semua konten telah disediakan oleh pihak ketiga yang tidak terafiliasi.</small>
    </div>

    <!-- Separator-->
    <div class="container">
        <div class="pt-1 bg-body rounded-pill"></div>
    </div>

    <!-- Copyrights-->
    <div class="container py-4">
        <div class="row text-center">
            <p class="text-muted text-sm mb-0"><?= $custom_theme['footer'] ?></span></p>
        </div>
    </div>

</footer>