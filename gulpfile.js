// Less configuration
var gulp = require('gulp');
var less = require('gulp-less');

gulp.task('less', function(cb) {
  gulp
    .src('./public/assets/less/*.less')
    .pipe(less())
    .pipe(gulp.dest('./public/assets/css/'));
  cb();
});

gulp.task(
  'default',
  gulp.series('less', function(cb) {
    gulp.watch('./public/assets/less/*.less', gulp.series('less'));
    cb();
  })
);