/* File: gulpfile.js */

// grab our gulp packages
var gulp = require('gulp'),
        gutil = require('gulp-util');
        sass = require('gulp-sass'),
        uglify = require('gulp-uglify'),
        notify = require('gulp-notify'),
        cleanCSS = require('gulp-clean-css'),
        autoprefixer = require('gulp-autoprefixer'),
        sourcemaps = require('gulp-sourcemaps'),
        concat = require('gulp-concat'),
        rename = require('gulp-rename'),
        plumber = require('gulp-plumber'),
        order = require('gulp-order'),
        merge = require('merge-stream'),
        rev = require('gulp-rev-append');

// create a default task and just log a message
gulp.task('default', function () {
    return gutil.log('Gulp is running!')
});


var jsAssets = [    
    './assets/js/foolish.js'
];

var cssAssets = [     
    './assets/css/styles.css'
];

var scssAssets = [
    './assets/scss/foolish.scss'
];

gulp.task('default', ['bundleJS', 'styles', 'rev']);

/*gulp.task('build-scss', function () {
    return gulp.src(scssAssets)
            .pipe(sass({
                errLogToConsole: true
            }));
});*/


gulp.task('bundleJS', function () {
    return gulp.src(jsAssets)
            .pipe(sourcemaps.init())
            .pipe(concat('scripts.js'))
            .pipe(gulp.dest('./assets/dist'))
            .on('error', notify.onError("Error: <%= error.message %>"))
            .pipe(rename({
                suffix: '.min'
            }))
            .pipe(uglify())
            .on('error', notify.onError("Error: <%= error.message %>"))
            .pipe(sourcemaps.write('/map'))
            .pipe(gulp.dest('./assets/dist'));
});


gulp.task('styles', function () {
    var sassStream,
            cssStream;

    cssStream = gulp.src(cssAssets);
    // .pipe(order(['./assets/css/10_uikit.css', './assets/css/20_default-skin.css', './assets/css/30_responsive.css']));

    sassStream = gulp.src('./assets/scss/foolish.scss')
            .pipe(sass({
                errLogToConsole: true
            }));

    //merge the two streams and concatenate their contents into a single file
    return merge(cssStream, sassStream)
            //.pipe(order(['/assets/raw/app.min.css','/assets/raw/foolish.css'],{ base: '.' }))
            .pipe(sourcemaps.init())
            .pipe(autoprefixer('last 2 versions'))
            .pipe(concat('foolish.css'))
            .pipe(gulp.dest('./assets/dist/'))
            .pipe(rename({suffix: '.min'}))
            .on('error', notify.onError("Error: <%= error.message %>"))
            //.pipe(sourcemaps.write('/mapcss'))
            .pipe(cleanCSS())
            .pipe(gulp.dest('./assets/dist/'));

});

// This task will add a cache  buster to file with  ?rev=@@hash added to it.  This forces a users cache to refresh anytime there is a change.

gulp.task('rev', function () {
    gulp.src('./assets/index.html')
            .pipe(rev())
            .pipe(gulp.dest('./assets/rev'));
});



//gulp.task('watch', function () {
//
//    //gulp.watch('./assets/scss/**/*.*', ['build-scss', 'rev']);
//    gulp.watch(jsAssets, ['bundleJS', 'rev']);
//    gulp.watch('./assets/scss/**/*.*',['styles', 'rev']);
//});