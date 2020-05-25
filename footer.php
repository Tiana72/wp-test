
</div>  <!-- wrapper -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?php
    wp_nav_menu(array(
        'theme_location'  => 'footer_menu2',
        'container_class'   => 'collapse navbar-collapse',
        'menu_class'        => 'navbar-nav mr-auto',
        'container_id'    => 'navbarSupportedContent',
        'walker' => new Test_Menu,
    )); ?>
</nav>

    <?php wp_footer(); ?>
    </body>
</html>