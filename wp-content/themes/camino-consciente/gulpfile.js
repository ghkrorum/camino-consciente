'use strict'
/* gulp definitions */
var gulp = require('gulp'),
    include = require('gulp-include'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass');

/* paths */
var assetsPath = "app/assets",
    jsPath = assetsPath + "/js/";

//javascripts
gulp.task('scripts', function() {  
    gulp.src("app/assets/js/main.js")
    .pipe(include())
    .on('error', console.log)
    .pipe(gulp.dest("public/js"))
});

gulp.task('scripts-prod', function() {
    return gulp.src("public/js/main.js")
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});
//Stylesheets
gulp.task('sass', function() {
    return gulp.src(assetsPath + '/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('public/css'));
});

gulp.task('sass-prod', function() {
    return gulp.src([assetsPath + '/sass/main.scss'])
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('public/css'));
});
//
gulp.task('html', function() {
    gulp.src('app/views/**/*.html')
    .pipe(gulp.dest('public'));
});
gulp.task('img', function() {
    gulp.src('app/assets/img/**/*.*')
    .pipe(gulp.dest('public/img'));
});

gulp.task('sass:watch', function() {
    gulp.watch('app/assets/scss/**/*.scss', ['sass']);
});
gulp.task('html:watch', function() {
    gulp.watch('app/views/**/*.html', ['html']);
});
gulp.task('img:watch', function() {
    gulp.watch('app/views/*.html', ['img']);
});
gulp.task('js:watch', function() {
    gulp.watch("app/assets/js/**/*.js", ['scripts']);
});

//
gulp.task('default', ['scripts', 'sass', 'img', 'html']);
gulp.task('watch', ['sass:watch', 'html:watch', 'img:watch', "js:watch"]);
gulp.task('production', ['scripts-prod', "sass-prod", "html", "img"]);