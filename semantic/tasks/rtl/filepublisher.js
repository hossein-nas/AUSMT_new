

var gulp    = require('gulp'),
    fs      = require('fs'),
    config  = require('../config/user'),
    tasks   = require('../config/tasks'),
    output  = config.paths.output,
    source  = config.paths.source,
    filenames = tasks.filenames
    ;

module.exports = function(){
    gulp.src(output.packaged + "/" + "*.css")
        .pipe(gulp.dest(output.cssDevelopment));
}