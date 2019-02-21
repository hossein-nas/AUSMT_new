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
    systemFiles:{
        fonts: {
            src : ["./storage/app/fonts/**/*"],
            dest : "./public/assets/fonts/"
        },
        imgs: {
            src: ["./storage/app/assets/img/**/*"],
            dest: "./public/assets/img/"
        },
        js: {
            src: ["./storage/app/assets/js/**/*"],
            dest: "./public/assets/js/"
        },
        fastmenu: {
            src: ["./storage/app/fastmenu/**/*"],
            dest: "./public/files/images/fastmenu_icons/"
        },
        filetypes: {
            src: ["./storage/app/filetypes/**/*"],
            dest: "./public/files/images/filetypes_icons/"
        },
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
        src: 'storage/app/assets/js/jquery*.js',
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
        .pipe(gulp.dest(paths.site.dest))
        .on( 'end' , function(){
            console.log("Site StyleSheet Bundle Successfully created at '" + paths.site.dest + "'\t\t\t \x1b[42m \u2713 \x1b[0m")
        })

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
        .pipe(gulp.dest(paths.cpanel.dest))
        .on( 'end' , function(){
            console.log("CPanel StyleSheet Bundle Successfully created at '" + paths.cpanel.dest + "'\t\t \x1b[42m \u2713 \x1b[0m")
        })
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
    .pipe( gulp.dest( paths.siteJsFiles.dest ))
    .on( 'end' , function(){
        console.log("Site JS Bundle Successfully created at '" + paths.siteJsFiles.dest + "'\t\t \x1b[42m \u2713 \x1b[0m")
    })

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
    .pipe( gulp.dest( paths.cpanelJsFiles.dest ))
    .on( 'end' , function(){
        console.log("CPanel JS Bundle Successfully created at '" + paths.cpanelJsFiles.dest + "'\t\t \x1b[42m \u2713 \x1b[0m")
    })


});

gulp.task('cpanel-vendors', function () {
    /*
    * minifying cpanel vendors JS files
    * */
    gulp.src( paths.jquery.src )
        .pipe( gulp.dest( paths.jquery.dist ))
        .pipe( uglify().on('error', gutil.log) )
        .pipe( rename('jquery-1.9.1.min.js'))
        .pipe( gulp.dest(paths.jquery.dist) )
        .on( 'end' , function(){
            console.log("Jquery Library Successfully created at '" + paths.jquery.dist + "'\t\t\t \x1b[42m \u2713 \x1b[0m")
        })

    gulp.src(paths.cpanelJsFiles.vendors)
        .pipe(concat('vendors.js'))
        .pipe(gulp.dest(paths.cpanelJsFiles.dest))
        .pipe(rename('vendors.min.js'))
        .pipe(uglify().on('error', gutil.log))
        .pipe(gulp.dest(paths.cpanelJsFiles.dest))
        .on( 'end' , function(){
            console.log("CPanel Vendors Successfully created at '" + paths.cpanelJsFiles.dest + "'\t\t \x1b[42m \u2713 \x1b[0m")
        })
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
        .pipe(gulp.dest(paths.siteJsFiles.dest))
        .on( 'end' , function(){
            console.log("Site Vendors Successfully created at '" + paths.siteJsFiles.dest + "'\t\t\t \x1b[42m \u2713 \x1b[0m")
        })
});

gulp.task('file_copy', function(){
    /*
    * Copying Fonts to public path
    * */
    gulp.src( paths.systemFiles.fonts.src )
        .pipe( gulp.dest( paths.systemFiles.fonts.dest ) )
        .on( 'end', function() {
            console.log("Fonts Successfully Copied at '"+ paths.systemFiles.fonts.dest +"'\t\t\t\t \x1b[42m \u2713 \x1b[0m")
        });

    /*
    * Copying System Images to public path
    * */
    gulp.src( paths.systemFiles.imgs.src )
        .pipe( gulp.dest( paths.systemFiles.imgs.dest ))
        .on( 'end', function() {
            console.log("System Images Successfully Copied at '"+ paths.systemFiles.imgs.dest +"'\t\t\t \x1b[42m \u2713 \x1b[0m")
        });

    /*
    * Copying JS files to public path
    * */
    gulp.src( paths.systemFiles.js.src )
        .pipe( gulp.dest( paths.systemFiles.js.dest ))
        .on( 'end', function() {
            console.log("JS Files Successfully Copied at '"+ paths.systemFiles.js.dest +"\'\t\t\t\t \x1b[42m \u2713 \x1b[0m")
        });

    /*
    * Copying Fastmenu Icons to public path
    * */
    gulp.src( paths.systemFiles.fastmenu.src )
        .pipe( gulp.dest( paths.systemFiles.fastmenu.dest ))
        .on( 'end', function() {
            console.log("Fastmenu Icons Successfully Copied at '"+ paths.systemFiles.fastmenu.dest +"'\t \x1b[42m \u2713 \x1b[0m")
        });

    /*
    * Copying Filetypes Icons to public path
    * */
    gulp.src( paths.systemFiles.filetypes.src )
        .pipe( gulp.dest( paths.systemFiles.filetypes.dest ))
        .on( 'end', function() {
            console.log("Filetype Icons Successfully Copied at '"+ paths.systemFiles.filetypes.dest +"'\t \x1b[42m \u2713 \x1b[0m")
        });

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
