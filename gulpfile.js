'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cssnano = require('gulp-cssnano');
var sourcemaps = require('gulp-sourcemaps');
var runSequence = require('run-sequence');


gulp.task('sass', function () {
  return gulp.src('assets/admin/scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(concat('main.css'))
    .pipe(sourcemaps.write())
    .pipe(cssnano())
    .pipe(gulp.dest('assets/admin/css'));
});

gulp.task('watch', function () {
  gulp.watch('assets/admin/scss/**/*.scss', ['sass']);
});

gulp.task('default', function (callback) {
  runSequence(['sass'], 'watch');
});
