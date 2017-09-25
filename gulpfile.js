var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var gutil = require('gulp-util');

var paths = {
    site: {
        dest: "public/assets/css",
        src: "resources/assets/sass/main.scss",
        watch_list: ['resources/assets/sass/partials/site/**/*.scss', 'resources/assets/sass/main.scss']
    },
    cpanel: {
        dest: "public/assets/css",
        src: "resources/assets/sass/cpanel.scss",
        watch_list: ['resources/assets/sass/partials/cpanel/**/*.scss', 'resources/assets/sass/cpanel.scss']
    },
    jsFiles: {
        dest: "public/assets/js",
        jquery: "resources/assets/jsFiles/jq.js",
        frameworks: "resources/assets/jsFiles/frameworks/*.js",
        custom: "resources/assets/jsFiles/custom/*.js"
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
    gulp.src(paths.jsFiles.jquery)
        .pipe(uglify())
        .pipe(gulp.dest(paths.jsFiles.dest));
    gulp.src(paths.jsFiles.frameworks)
        .pipe(concat('plugins.js'))
        .pipe(gulp.dest(paths.jsFiles.dest))
        .pipe(rename('plugins.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.jsFiles.dest));
    gulp.src(paths.jsFiles.custom)
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(paths.jsFiles.dest))
        .pipe(rename('scripts.min.js'))
        .pipe(
            uglify().on('error', gutil.log)
        )
        .pipe(gulp.dest(paths.jsFiles.dest));
});

gulp.task('watch', function () {
    gulp.watch([paths.cpanel.watch_list, paths.site.watch_list], ['sass']);
    gulp.watch('resources/assets/jsFiles/**/*.js', ['minify']);
});

gulp.task('default', ['sass', 'minify', 'watch']);