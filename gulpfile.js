const gulp = require('gulp');
const browserSync = require('browser-sync');
const pug = require('gulp-pug');
const stylus = require('gulp-stylus');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const data = require('gulp-data');
const plumber = require('gulp-plumber');
const fs = require('fs');
const spritesmith = require('gulp.spritesmith');
const gulpIf = require('gulp-if');
const csso = require('gulp-csso');
const uglify = require('gulp-uglify');
const minify = require('gulp-minify');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const imagemin = require('gulp-imagemin');
const sourcemaps = require('gulp-sourcemaps');
const svgSprites = require('gulp-svg-sprites');
const ftp = require('gulp-ftp');
const rename = require('gulp-rename');

const isProduction= process.env.NODE_ENV ? true : false;

gulp.task('serve', ['pug', 'sass', 'js', 'copy', 'sprite-svg'], () => {
/*	browserSync.init({
		server: {
			baseDir: "./build/"
		}
	});
*/
	gulp.watch('src/**/*', ['copy']);
	gulp.watch('build/**/*', ['copy_in_server']);
	gulp.watch('src/assets/icons', ['sprite-svg']);
	gulp.watch('src/**/*.sass', ['sass']);
	gulp.watch('src/**/*.pug', ['pug']);
	gulp.watch('src/**/*.js', ['js']);
	gulp.watch('src/data/*.json', ['pug', 'sass', 'js']);
	gulp.watch('build/**/*.*').on('change', browserSync.reload);
});

// PUG
gulp.task('pug', () => {
	return gulp.src('src/pages/*.pug')
	.pipe(data( ()=> {
		return JSON.parse(fs.readFileSync('./src/data/data.json'));
	}))
	.pipe(pug({pretty: true}).on( 'error', ( error ) => {
		console.log( error );
	}))
	.pipe(gulp.dest('build'));
});

// SASS
gulp.task('sass', () => {
	setTimeout( () => {
		return gulp.src('src/assets/style.sass')
			.pipe(plumber())
			.pipe(sass())
			.pipe(gulpIf( !isProduction, sourcemaps.init() ))
			.pipe(autoprefixer())
			.pipe(gulpIf( isProduction, csso() ))
			.pipe(gulpIf( !isProduction, sourcemaps.write() ))
		.pipe(gulp.dest('build/css/'));
	},500 );
});

// JS
gulp.task('js', () => {
	return gulp.src('src/block/**/*.js')
		.pipe(babel({presets: ['es2015']}))
		.pipe(gulpIf( !isProduction, sourcemaps.init() ))
		.pipe(concat('app.js'))
		.pipe(gulpIf( isProduction, minify({ext : {
					src : '-debug.js',
					min : '.js'
				}
			})
		))
		.pipe(gulpIf( !isProduction, sourcemaps.write() ))
	.pipe(gulp.dest('build/js/'));
});

// COPY
gulp.task('copy', () => {
	gulp.src('src/assets/fonts/**/*')
		.pipe(gulp.dest('build/fonts'))
	gulp.src('src/assets/root/**/*')
		.pipe(gulp.dest('build'))
	gulp.src('src/*.php')
		.pipe(gulp.dest('build'))
	gulp.src('src/model/**/*.php')
		.pipe(gulp.dest('build/model'))
	gulp.src('src/controller/**/*')
		.pipe(gulp.dest('build/controller'))
	gulp.src('src/block/**/*.php')
		.pipe(rename({dirname: ''}))
		.pipe(gulp.dest('build/view'))
	gulp.src(['src/assets/img/**/*', '!src/assets/img/sprite/*'])
		//.pipe(imagemin())
		.pipe(gulp.dest('build/img'));
});

// COPY
gulp.task('copy_in_server', () => {
	gulp.src('build/**/*')
		.pipe(gulp.dest('../OpenServer/OSPanel/domains/localhost'))
});

// SVG sprite

gulp.task('sprite-svg', ()=> {
	/*
	return gulp.src('src/assets/icons/*.svg')
	.pipe(svgSprites({
		svg: { sprite: "icons.svg" },
		preview: { 	sprite: "icons.html" }
	}))
	.pipe(gulp.dest('build/img'));
	*/
});

gulp.task('default', ['serve']);