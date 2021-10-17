// Gulp.js configuration
'use strict';

const
  // source and build folders
  dir = {
    src         : './',
    build       : './dist/astronauta/'
  },
  // JavaScript settings
  js = {
    src         : dir.src + 'js/**/*',
    watch       : dir.src + 'js/*.js',
    build       : dir.build,
    serve       : dir.src,
    filename    : 'scripts.js'
  },
  images = {
    src         : dir.src + 'images-original/**/*',
    serve       : dir.src + 'images/',
    build       : dir.build + 'images/',
    watch       : dir.src + 'images-original/*'
  },
  css = {
    src         : dir.src + 'scss/style.scss',
    watch       : dir.src + 'scss/*.scss',
    serve       : dir.src,
    build       : dir.build,
    sassOpts: {
      style     : 'nested',
      imagePath       : images.build,
      precision       : 3,
      errLogToConsole : true
    },
    processors: [
      require('postcss-assets')({
        loadPaths: ['images/'],
        basePath: dir.build,
        baseUrl: './'
      }),
      require('autoprefixer')({
        browsers: ['last 2 versions', '> 2%']
      }),
      require('css-mqpacker'),
      require('cssnano')
    ]
  },
  syncOpts = {
    proxy       : 'http://localhost:8888/antss',
    files       : dir.src + '**/*',
    open        : false,
    notify      : false,
    ghostMode   : false,
    ui: {
      port: 8181
    }
  },

  // Gulp and plugins
  gulp          = require('gulp'),
  gutil         = require('gulp-util'),
  newer         = require('gulp-newer'),
  imagemin      = require('gulp-imagemin'),
  sass          = require('gulp-sass')(require('sass')),
  postcss       = require('gulp-postcss'),
  deporder      = require('gulp-deporder'),
  concat        = require('gulp-concat'),
  stripdebug    = require('gulp-strip-debug'),
  uglify        = require('gulp-uglify');

let browserSync = false;

// image processing
gulp.task('images', () => {
  return gulp.src(images.src)
    .pipe(newer(images.serve))
    .pipe(imagemin())
    .pipe(gulp.dest(images.serve));
});


// CSS processing
gulp.task('css', gulp.series('images', () => {
  return gulp.src(css.src)
    .pipe(sass(css.sassOpts))
    .pipe(postcss(css.processors))
    .pipe(gulp.dest(css.serve))
    .pipe(browserSync ? browserSync.reload({ stream: true }) : gutil.noop());
}));

// JavaScript processing
gulp.task('js', () => {
  return gulp.src(js.src)
    .pipe(deporder())
    .pipe(concat(js.filename))
    .pipe(stripdebug())
    .pipe(uglify())
    .pipe(gulp.dest(js.serve))
    .pipe(browserSync ? browserSync.reload({ stream: true }) : gutil.noop());
});

// Build PHP files final template
gulp.task('build-php', () => {
  return gulp.src(dir.src + '**/*.php')
    .pipe(newer(dir.build))
    .pipe(gulp.dest(dir.build));
});

// Build CSS files final template
gulp.task('build-css', () => {
  return gulp.src(dir.src + 'style.css')
    .pipe(newer(dir.build))
    .pipe(gulp.dest(dir.build));
});

// Build js files final template
gulp.task('build-js', () => {
  return gulp.src(dir.src + 'scripts.js')
    .pipe(newer(dir.build))
    .pipe(gulp.dest(dir.build));
});

// Build images files final template
gulp.task('build-images',() => {
  return gulp.src(dir.src + 'images/**/*')
    .pipe(newer(images.build))
    .pipe(gulp.dest(images.build));
});

// watch for file changes
gulp.task('serve', () => {
  if (browserSync === false) {
    browserSync = require('browser-sync').create();
    browserSync.init(syncOpts);
  }
  gulp.watch(css.watch, gulp.series('css'), browserSync.reload);
  gulp.watch(images.watch, gulp.series('images'), browserSync.reload);
  gulp.watch(js.watch, gulp.series('js'), browserSync.reload);
  //gulp.watch(dir.src + '**/*').on("change", browserSync.reload);
});

// run all tasks - build
gulp.task('build', gulp.series('css', 'js', 'build-php', 'build-images', 'build-css', 'build-js', () => {}));
