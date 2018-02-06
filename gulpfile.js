var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var gutil = require('gulp-util');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');

var paths = {
    initialStorageFile:{
        fontsSrcDir: ["./storage/app/fonts/**/*"],
        fontsDistDir: "./public/assets/fonts/"
    },
    site: {
        dest: "public/assets/css",
        src: "resources/assets/sass/main.scss",
        watch_list: ['resources/assets/sass/partials/site/**/*.scss', 'resources/assets/sass/main.scss']
    },
    cpanel: {
        dest: "public/assets/css",
        src: "resources/assets/sass/cpanel.scss",
        watch_list: ['resources/assets/sass/partials/cpanel/**.scss', 'resources/assets/sass/cpanel.scss']
    },
    cpanelJsFiles: {
        vendors: 'resources/assets/jsFiles/cpanel/vendor/*.js',
        bundle: 'resources/assets/jsFiles/cpanel/scripts.js',
        dest: 'public/assets/js/cpanel',
        ckeditor: {
            src : ['./storage/app/assets/js/CKEditor/**/*'],
            dist: './public/assets/js/libs/ckeditor/'
        },
        watchlist: {
            vendor : ['resources/assets/jsFiles/cpanel/vendor/**/*.js'],
            script : [
                'resources/assets/jsFiles/cpanel/scripts.js',
                'resources/assets/jsFiles/cpanel/scripts/**/*.js'
            ]
        }
    },
    siteJsFiles : {
        vendors : 'resources/assets/jsFiles/site/vendor/**/*.js',
        bundle : 'resources/assets/jsFiles/site/scripts.js',
        dest : 'public/assets/js/site',
        watchlist: {
            vendor : ['resources/assets/jsFiles/site/vendor/**/*.js'],
            script : [
                'resources/assets/jsFiles/site/scripts.js',
                'resources/assets/jsFiles/site/scripts/**/*.js'
            ]
        }
    },
    jquery: {
        src: 'storage/app/assets/js/jquery-1.9.1.js',
        dist: 'public/assets/js/libs/'
    }
};

gulp.task('sass', function () {
    gulp.src(paths.site.src)
        .pipe(
            sass().on("error", gutil.log)
        )
        .pipe(autoprefixer('last 100 version'))
        .pipe(gulp.dest(paths.site.dest));
    gulp.src(paths.site.src)
        .pipe(
            sass({outputStyle: 'compressed'}).on("error", gutil.log)
        )
        .pipe(autoprefixer('last 100 version'))
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest(paths.site.dest));

    gulp.src(paths.cpanel.src)
        .pipe(
            sass().on("error", gutil.log)
        )
        .pipe(autoprefixer('last 100 version'))
        .pipe(gulp.dest(paths.cpanel.dest));
    gulp.src(paths.cpanel.src)
        .pipe(
            sass({outputStyle: 'compressed'}).on("error", gutil.log)
        )
        .pipe(autoprefixer('last 100 version'))
        .pipe(rename('cpanel.min.css'))
        .pipe(gulp.dest(paths.cpanel.dest));
});


gulp.task('minify', function () {
    // gulp.src(paths.jsFiles.jquery)
    //     .pipe(uglify())
    //     .pipe(gulp.dest(paths.jsFiles.dest));
    // gulp.src(paths.jsFiles.frameworks)
    //     .pipe(concat('plugins.js'))
    //     .pipe(gulp.dest(paths.jsFiles.dest))
    //     .pipe(rename('plugins.min.js'))
    //     .pipe(uglify())
    //     .pipe(gulp.dest(paths.jsFiles.dest));
    // gulp.src(paths.jsFiles.custom)
    //     .pipe(concat('scripts.js'))
    //     .pipe(gulp.dest(paths.jsFiles.dest))
    //     .pipe(rename('scripts.min.js'))
    //     .pipe(
    //         uglify().on('error', gutil.log)
    //     )
    //     .pipe(gulp.dest(paths.jsFiles.dest));

});

gulp.task('site-scripts', function () {
    /*
    * minifying site JS files
    * */
    browserify({
        entries: paths.siteJsFiles.bundle,
        debug: true
    })
    .transform(babelify)
    .on('error', gutil.log)
    .bundle()
    .on('error', gutil.log)
    .pipe(source('bundle.js'))
    .pipe(gulp.dest(paths.siteJsFiles.dest))
    .pipe(buffer())
    .pipe(uglify())
    .on('error', gutil.log)
    .pipe( rename('bundle.min.js') )
    .pipe( gulp.dest( paths.siteJsFiles.dest ));

});


gulp.task('cpanel-scripts', function () {
    /*
    * minifying cpanel JS files
    * */
    browserify({
        entries: paths.cpanelJsFiles.bundle,
        debug: true
    })
    .transform(babelify)
    .on('error', gutil.log)
    .bundle()
    .on('error', gutil.log)
    .pipe(source('bundle.js'))
    .pipe(gulp.dest(paths.cpanelJsFiles.dest))
    .pipe(buffer())
    .pipe(uglify())
    .on('error', gutil.log)
    .pipe( rename('bundle.min.js') )
    .pipe( gulp.dest( paths.cpanelJsFiles.dest ));

});

gulp.task('cpanel-vendors', function () {
    /*
    * minifying cpanel vendors JS files
    * */
    gulp.src( paths.jquery.src )
        .pipe( gulp.dest( paths.jquery.dist ))
        .pipe( uglify().on('error', gutil.log) )
        .pipe( rename('jquery-1.9.1.min.js'))
        .pipe( gulp.dest(paths.jquery.dist) );

    gulp.src(paths.cpanelJsFiles.vendors)
        .pipe(concat('vendors.js'))
        .pipe(gulp.dest(paths.cpanelJsFiles.dest))
        .pipe(rename('vendors.min.js'))
        .pipe(uglify().on('error', gutil.log))
        .pipe(gulp.dest(paths.cpanelJsFiles.dest));
});

gulp.task('site-vendors', function () {
    /*
    * minifying cpanel vendors JS files
    * */
    gulp.src(paths.siteJsFiles.vendors)
        .pipe(concat('vendors.js'))
        .pipe(gulp.dest(paths.siteJsFiles.dest))
        .pipe(rename('vendors.min.js'))
        .pipe(uglify().on('error', gutil.log))
        .pipe(gulp.dest(paths.siteJsFiles.dest));
});

gulp.task('file_copy', function(){
    /* ------------------------------------
        Copying Fonts to public folder
    ------------------------------------ */
    gulp.src(paths.initialStorageFile.fontsSrcDir)
    .pipe(gulp.dest(paths.initialStorageFile.fontsDistDir));
    
    gulp.src( paths.cpanelJsFiles.ckeditor.src )
    .pipe( gulp.dest( paths.cpanelJsFiles.ckeditor.dist ))
})

gulp.task('watch', function () {
    gulp.watch([paths.cpanel.watch_list, paths.site.watch_list], ['sass']);

    gulp.watch(paths.cpanelJsFiles.watchlist.vendor, ['cpanel-vendors'])
    gulp.watch(paths.cpanelJsFiles.watchlist.script, ['cpanel-scripts'])

    gulp.watch(paths.siteJsFiles.watchlist.vendor, ['site-vendors'])
    gulp.watch(paths.siteJsFiles.watchlist.script, ['site-scripts'])
});


gulp.task('build', [
    'sass',
    'file_copy',
    'cpanel-vendors',
    'site-vendors',
    'site-scripts',
    'cpanel-scripts',
])
gulp.task('default', ['build', 'watch']);
