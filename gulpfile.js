var gulp         = require('gulp'),
	less         = require('gulp-less'),
	autoprefixer = require('gulp-autoprefixer'),
	cleanCSS     = require('gulp-clean-css'),
	rename       = require('gulp-rename'),
	browserSync  = require('browser-sync').create(),
	concat       = require('gulp-concat'),
	uglify       = require('gulp-uglify');

gulp.task('browser-sync', ['styles', 'scripts'], function() {
		browserSync.init({
				proxy: "optimized.dev",
				notify: false
		});
});

gulp.task('styles', function () {
	return gulp.src('less/*.less')
	.pipe(less())
	.pipe(rename({suffix: '.min', prefix : ''}))
	.pipe(autoprefixer({browsers: ['last 15 versions'], cascade: false}))
	.pipe(gulp.dest('app/css'))
	.pipe(browserSync.stream());
// добавить после автопрефикса .pipe(cleanCSS())
});

gulp.task('scripts', function() {
	return gulp.src('./app/libs/**/*.js')
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(gulp.dest('./app/js/'))
});

gulp.task('watch', function () {
	gulp.watch('less/**/*.less', ['styles']);
	gulp.watch('app/libs/**/*.js', ['scripts']);
	gulp.watch('app/js/*.js').on("change", browserSync.reload);
	gulp.watch('app/**/*.php').on('change', browserSync.reload);
});

gulp.task('default', ['browser-sync', 'watch']);
