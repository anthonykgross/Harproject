var gulp = require('gulp'),
        rename = require('gulp-rename'),
        uglify = require('gulp-uglify'),
        header = require('gulp-header'),
        concat = require('gulp-concat'),
        bower = require('gulp-bower');

gulp.task('bower', function () {
    return bower();
});

gulp.task('build', ['bower'], function () {
    return ;
});

gulp.task('default', ['build']);
