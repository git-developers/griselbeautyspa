var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    //.setPublicPath('/build')
    .setPublicPath('build')
    
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })

    /*
    .copyFiles({
        from: './assets/images'
    })
    */

    
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('jquery.min', './assets/plugins/jquery/jquery.min.js')
    .addEntry('jquery-ui.min', './assets/plugins/jquery-ui/jquery-ui.min.js')
    .addEntry('bootstrap.bundle.min', './assets/plugins/bootstrap/js/bootstrap.bundle.min.js')
    .addEntry('Chart.min', './assets/plugins/chart.js/Chart.min.js')
    .addEntry('sparkline', './assets/plugins/sparklines/sparkline.js')
    .addEntry('jquery.vmap.min', './assets/plugins/jqvmap/jquery.vmap.min.js')
    .addEntry('jquery.vmap.usa', './assets/plugins/jqvmap/maps/jquery.vmap.usa.js')
    .addEntry('jquery.knob.min', './assets/plugins/jquery-knob/jquery.knob.min.js')
    .addEntry('moment.min', './assets/plugins/moment/moment.min.js')
    .addEntry('daterangepicker-css', './assets/plugins/daterangepicker/daterangepicker.js')
    .addEntry('tempusdominus-bootstrap-4.min-css', './assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')
    .addEntry('summernote-bs4.min', './assets/plugins/summernote/summernote-bs4.min.js')
    .addEntry('jquery.overlayScrollbars.min', './assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')
    .addEntry('adminlte', './assets/dist/js/adminlte.js')
    .addEntry('dashboard', './assets/dist/js/pages/dashboard.js')
    .addEntry('bootstrap-switch.min', './assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')
    .addEntry('demo', './assets/dist/js/demo.js')

    // FRONT-END
    .addEntry('frontend-jquery', './assets/frontend/js/jquery.js')
    .addEntry('frontend-jquery-migrate.min', './assets/frontend/js/jquery-migrate.min.js')
    .addEntry('frontend-core.min', './assets/frontend/js/core.min.js')
    //.addEntry('frontend-datepicker.min', './assets/frontend/js/datepicker.min.js')
    .addEntry('frontend-spin.min', './assets/frontend/js/spin.min.js')
    //.addEntry('frontend-spin.jquery', './assets/frontend/js/spin.jquery.js')
    .addEntry('frontend-jquery.tooltipster.min', './assets/frontend/js/jquery.tooltipster.min.js')
    .addEntry('frontend-functions', './assets/frontend/js/functions.js')
    .addEntry('frontend-contact-form-scripts', './assets/frontend/js/contact-form-scripts.js')
    .addEntry('frontend-jquery.blockUI.min', './assets/frontend/js/jquery.blockUI.min.js')
    .addEntry('frontend-cart-fragments.min', './assets/frontend/js/cart-fragments.min.js')
    .addEntry('frontend-bootstrap.min-js', './assets/frontend/js/bootstrap.min.js')
    .addEntry('frontend-owl.carousel.min-js', './assets/frontend/js/owl.carousel.min.js')
    .addEntry('frontend-custom', './assets/frontend/js/custom.js')
    .addEntry('frontend-tilt.jquery.min', './assets/frontend/js/tilt.jquery.min.js')
    .addEntry('frontend-wp-embed.min', './assets/frontend/js/wp-embed.min.js')
    .addEntry('frontend-imagesloaded.min', './assets/frontend/js/imagesloaded.min.js')
    .addEntry('frontend-frontend-modules.min', './assets/frontend/js/frontend-modules.min.js')
    .addEntry('frontend-position.min', './assets/frontend/js/position.min.js')
    .addEntry('frontend-dialog.min', './assets/frontend/js/dialog.min.js')
    .addEntry('frontend-waypoints.min', './assets/frontend/js/waypoints.min.js')
    .addEntry('frontend-swiper.min', './assets/frontend/js/swiper.min.js')
    .addEntry('frontend-share-link.min', './assets/frontend/js/share-link.min.js')
    .addEntry('frontend-frontend.min-js', './assets/frontend/js/frontend.min.js')
    .addEntry('frontend-rocket-loader.min', './assets/frontend/js/rocket-loader.min.js')


    //.addStyleEntry('all.min', './assets/plugins/fontawesome-free/css/all.min.css')

    .addStyleEntry('app-scss', './assets/css/app.scss')
    .addStyleEntry('tempusdominus-bootstrap-4.min-js', './assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')
    .addStyleEntry('icheck-bootstrap.min', './assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')
    .addStyleEntry('jqvmap.min', './assets/plugins/jqvmap/jqvmap.min.css')
    .addStyleEntry('adminlte.min', './assets/dist/css/adminlte.min.css')
    .addStyleEntry('OverlayScrollbars.min', './assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')
    .addStyleEntry('daterangepicker-js', './assets/plugins/daterangepicker/daterangepicker.css')
    .addStyleEntry('summernote-bs4', './assets/plugins/summernote/summernote-bs4.css')

    // FRONT-END
    .addStyleEntry('frontend-style.min', './assets/frontend/css/style.min.css')
    .addStyleEntry('frontend-style', './assets/frontend/css/style.css')
    .addStyleEntry('frontend-icons', './assets/frontend/css/icons.css')
    .addStyleEntry('frontend-tooltipster', './assets/frontend/css/tooltipster.css')
    .addStyleEntry('frontend-tooltipster-light', './assets/frontend/css/tooltipster-light.css')
    .addStyleEntry('frontend-animations', './assets/frontend/css/animations.css')
    .addStyleEntry('frontend-booked-styles', './assets/frontend/css/booked-styles.css')
    .addStyleEntry('frontend-responsive', './assets/frontend/css/responsive.css')
    .addStyleEntry('frontend-contact-form-styles', './assets/frontend/css/contact-form-styles.css')
    .addStyleEntry('frontend-bootstrap.min-css', './assets/frontend/css/bootstrap.min.css')
    .addStyleEntry('frontend-owl.carousel.min-css', './assets/frontend/css/owl.carousel.min.css')
    .addStyleEntry('frontend-angel-child-style', './assets/frontend/css/angel-child-style.css')
    .addStyleEntry('frontend-elementor-icons.min', './assets/frontend/css/elementor-icons.min.css')
    .addStyleEntry('frontend-animations.min', './assets/frontend/css/animations.min.css')
    .addStyleEntry('frontend-frontend.min-css', './assets/frontend/css/frontend.min.css')
    .addStyleEntry('frontend-global', './assets/frontend/css/global.css')
    .addStyleEntry('frontend-post-2224', './assets/frontend/css/post-2224.css')


    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
