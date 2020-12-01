        </div>
        <div class="bg-light fixed-bottom text-center">
            <nav class="navbar navbar-expand-lg navbar-light text-center pb-0">
                <div class="collapse navbar-collapse mx-auto" id="navbarNav">
                    <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'menu_class' => 'navbar-nav mx-auto']);

                    //the_widget(YoutubeWidget::class, ['title' => "salut", 'youtube' => "hhNctIlXVsw"]) 
                    ?>
                </div>
            </nav>
            <div class="text-center pb-3 text-muted">
                <small>
                    <?= get_option('agence_horaire'); ?> /
                    <?= get_option('agence_date'); ?>
                </small>
            </div>
        </div>
        <?= wp_footer() ?>
        </body>

        </html>