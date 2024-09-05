'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

//compile SCSS
gulp.task('sass', () =>  {
    gulp.src('src/scss/*.scss')
        .pipe(
            sass().on('error', sass.logError)
        )
        .pipe(gulp.dest('assets/css'));
});

// Watch
gulp.task('sass:watch', () =>  {
    gulp.run( ['sass'] );
    gulp.watch('src/scss/*.scss', ['sass']);
});