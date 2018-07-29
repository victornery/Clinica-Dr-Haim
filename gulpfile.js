"use strict";

/**
 *  Gulpfile.js made by Victor Nery
 *  Initially for projects with SASS
 *  ES6, Components to made a WP Theme
 *
 *  @author victornery
 */

const gulp = require("gulp");
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const babel = require("gulp-babel");
const rename = require("gulp-rename");
const imagemin = require("gulp-imagemin");
const postcss = require("gulp-postcss");
const autoprefixer = require('autoprefixer');

const folders = {
  dev: "./src",
  prod: "./public/wp-content/themes/dr-haim"
};

gulp.task("scss", function() {
  var plugins = [
    autoprefixer({browsers: ['last 1 version']}),
  ];
  return gulp.src(folders.dev + "/scss/main.scss")
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(postcss(plugins))
    .pipe(rename("main.min.css"))
    .pipe(gulp.dest(folders.prod + "/dist/css/"))
});

gulp.task("js", function() {
  return gulp
    .src(folders.dev + "/js/**/*.js")
    .pipe(babel({ presets: ["env"] }))
    .pipe(concat("main.min.js"))
    .pipe(uglify())
    .pipe(gulp.dest(folders.prod + "/dist/js/"))
});

gulp.task("imgs", function() {
  return gulp
    .src(folders.dev + "/images/*")
    .pipe(
      imagemin([
        imagemin.jpegtran({ progressive: true }),
        imagemin.optipng({ optimizationLevel: 5 }),
        imagemin.svgo({
          plugins: [
            { removeViewBox: false },
            { removeMetadata: true },
            { minifyStyles: true },
            { convertColors: true }
          ]
        })
      ])
    )
    .pipe(gulp.dest(folders.prod + "/dist/images"))
});

gulp.task("php", function() {
  return gulp.src(folders.dev + "/php/**/*.php")
  .pipe(gulp.dest(folders.prod));
});

gulp.task("default", function() {
  gulp.watch(folders.dev + "/scss/**/*.scss", ["scss"]);
  gulp.watch(folders.dev + "/php/**", ["php"]);
  gulp.watch(folders.dev + "/js/**", ["js"]);
  gulp.watch(folders.dev + "/images/**", ["imgs"]);
});
