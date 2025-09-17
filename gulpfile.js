// Gulpfile.js - Configuration pour structure modulaire LESS
var gulp = require('gulp');
var less = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var path = require('path');

// Configuration des chemins
const paths = {
  less: {
    src: './assets/styles/Less/',
    dest: './assets/styles/css/',
    // Points d'entrée principaux (fichiers sans underscore)
    entries: [
      './assets/styles/Less/app.less',
      './assets/styles/Less/admin/admin.less',
      './assets/styles/Less/user/user.less',
      // Ajout des autres points d'entrée potentiels
      './assets/styles/Less/components/*.less',
      './assets/styles/Less/layout/*.less',
      './assets/styles/Less/pages/*.less',
      // Exclure les fichiers partiels (commençant par _)
      '!./assets/styles/Less/**/_*.less'
    ],
    // Tous les fichiers LESS pour le watch
    watch: './assets/styles/Less/**/*.less'
  }
};

// Gestion des erreurs
function handleError(err) {
  console.log('\n');
  console.log('LESS Error:');
  console.log('File: ' + err.filename);
  console.log('Line: ' + err.line);
  console.log('Column: ' + err.column);
  console.log('Message: ' + err.message);
  console.log('\n');
  this.emit('end');
}

// Tâche de compilation LESS
gulp.task('less', function() {
  return gulp
    .src(paths.less.entries)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less({
      paths: [path.join(__dirname, 'assets/styles/Less')]
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(function(file) {
      // Maintient la structure des dossiers
      const relativePath = path.relative('./assets/styles/Less/', file.path);
      const directory = path.dirname(relativePath);
      
      // Si le fichier est dans un sous-dossier, maintenir la structure
      if (directory !== '.') {
        return path.join(paths.less.dest, directory);
      } else {
        return paths.less.dest;
      }
    }));
});

// Tâche de minification pour la production
gulp.task('less:prod', function() {
  return gulp
    .src(paths.less.entries)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(less({
      paths: [path.join(__dirname, 'assets/styles/Less')]
    }))
    .pipe(cleanCSS({
      compatibility: 'ie8',
      level: 2
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(function(file) {
      const relativePath = path.relative('./assets/styles/Less/', file.path);
      const directory = path.dirname(relativePath);
      
      if (directory !== '.') {
        return path.join(paths.less.dest, directory);
      } else {
        return paths.less.dest;
      }
    }));
});

// Tâche de compilation complète (dev + prod)
gulp.task('less:all', gulp.parallel('less', 'less:prod'));

// Tâche de surveillance
gulp.task('watch', function() {
  gulp.watch(paths.less.watch, gulp.series('less'));
});

// Tâche par défaut
gulp.task('default', gulp.series('less', 'watch'));

// Tâche de build pour la production
gulp.task('build', gulp.series('less:all'));

// Tâches individuelles pour chaque section
gulp.task('less:app', function() {
  return gulp
    .src('./assets/styles/Less/app.less')
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest));
});

gulp.task('less:admin', function() {
  return gulp
    .src('./assets/styles/Less/admin/admin.less')
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest + 'admin/'));
});

gulp.task('less:user', function() {
  return gulp
    .src('./assets/styles/Less/user/user.less')
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest + 'user/'));
});

gulp.task('less:components', function() {
  return gulp
    .src(['./assets/styles/Less/components/*.less', '!./assets/styles/Less/components/_*.less'])
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest + 'components/'));
});

gulp.task('less:layout', function() {
  return gulp
    .src(['./assets/styles/Less/layout/*.less', '!./assets/styles/Less/layout/_*.less'])
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest + 'layout/'));
});

gulp.task('less:pages', function() {
  return gulp
    .src(['./assets/styles/Less/pages/*.less', '!./assets/styles/Less/pages/_*.less'])
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.less.dest + 'pages/'));
});
