'use strict';
const 	gulp 	= require('gulp'),
		del 	= require('del'),
		ftp = require( 'vinyl-ftp' ),
		gutil = require( 'gulp-util' ),
		ttf2woff2 = require('gulp-ttf2woff2'),
		plugins = require('gulp-load-plugins')();

const path =  {
		build	: './build/',           // paths.build
		src		: './src/',            // paths.src
		styles	: {
			src			:   'src/scss/**/*.scss',
			main		:   'src/scss/style.scss',
			singlePage	:   'src/scss/single-page.scss',
			plugins		: 	'src/scss/plugins/',
			dest		:   'build/'
		} ,
		php 	: 	'./src/*.php',
		images	:  {
			src	:   'src/images/**/*.*',
			dest:   'build/images/'
		},
		scripts	: {
			src	:   'src/js/**/*.js',
			dest:   'build/js/'
		},
		fonts	: {
			src	:   'src/fonts/result/**/*.*',
			dest:   'build/fonts/',
			ttf	:	'src/fonts/ttf/**/*.ttf'
		},
		modules	: {
			normalize	: {
				src		:   'node_modules/normalize.css/**/*.*',
				bin		:   'node_modules/normalize.css/normalize.css'
			},
			fontAwesome	: {
				src		:  'node_modules/font-awesome/**/*.*',
				scss	:  'node_modules/font-awesome/scss/*.scss',
				fonts	:  'node_modules/font-awesome/fonts/fontawesome-webfont.*'
			}
		}

};
//подключение scss плагинов
gulp.task('normalize', function(){
	return gulp.src(path.modules.normalize.bin)
	.pipe(plugins.rename({extname: ".scss"}))
    .pipe(gulp.dest(path.styles.plugins))
});

gulp.task('fontAwesome', function(){
	return gulp.src(path.modules.fontAwesome.scss)
	.pipe(gulp.dest(path.styles.plugin + 'fontAwesome/'))
});


//очищение build
gulp.task ('del', function() {
	return del(path.build);
 });

 
 
 //конвертируем шрифты
gulp.task('ttf2woff2', function(){
	return gulp.src(['./src/fonts/ttf/*.ttf'])
   .pipe(ttf2woff2())
   .pipe(gulp.dest('./src/fonts/result'));
});

//подключаем шрифты
 gulp.task('fonts', function(){
	return gulp.src([path.modules.fontAwesome.fonts, path.fonts.src])
	 .pipe(gulp.dest(path.fonts.dest));
 });

 //компиляция scss
gulp.task('scss', function() { 
    return gulp.src(path.styles.main)                
    .pipe(plugins.plumber())                                    
    // .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sassGlob())                           
    .pipe(plugins.sass({outputStyle: 'compressed', sourceComments: 'true'}))                                       
    .pipe(plugins.autoprefixer({                                
        browsers: ['last 2 versions'],
        cascade: false
    }))
	.pipe(plugins.csso())
    // .pipe(plugins.sourcemaps.write())
    .pipe(gulp.dest(path.styles.dest));                       
});

gulp.task('singlePage', function() {
	return gulp.src(path.styles.singlePage)                
    .pipe(plugins.plumber())                                    
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sassGlob())                           
    .pipe(plugins.sass({outputStyle: 'compressed', sourceComments: 'true'}))                                       
    .pipe(plugins.autoprefixer({                                
        browsers: ['last 2 versions'],
        cascade: false
    }))
	.pipe(plugins.csso())
    .pipe(plugins.sourcemaps.write())
    .pipe(gulp.dest(path.styles.dest)); 
});

//обработчик изображений
gulp.task('img', function(){
    return gulp.src(path.images.src)
    .pipe(plugins.imagemin())
    .pipe(gulp.dest(path.images.dest));
});

//обработчик JS
gulp.task('js', function(){
	return gulp.src(path.scripts.src)
	.pipe(plugins.plumber())
	.pipe(plugins.concat('script.js'))
	.pipe(plugins.uglify())
	.pipe(gulp.dest(path.scripts.dest));
});

//перенос PHP
gulp.task('php', function() {
	return gulp.src(path.php)
	.pipe(plugins.plumber())
	.pipe(gulp.dest(path.build));
});


//слежение за файлами
gulp.task('watch', function(){
    gulp.watch(path.styles.src, gulp.series('scss', 'deploy'));
    gulp.watch(path.images.src, gulp.series('img', 'deploy'));
    gulp.watch(path.fonts.src, gulp.series('fonts', 'deploy'));
    gulp.watch(path.scripts.src, gulp.series('js', 'deploy'));
    gulp.watch(path.php, gulp.series('php', 'deploy'));
});

//сборка
gulp.task('build', gulp.series(
	'del',
	gulp.parallel(
		gulp.series('scss', 'singlePage'),
		'js',
		'php',
		'img',
		'fonts'
		)
  ));

//деплой на сервер
gulp.task('deploy', function(){		
	const connect = ftp.create({		
		host		: 	'***',		
		user		: 	'***',		
		pass		: 	'***',		
		parallel	: 	5,		
		log			:   gutil.log		
				
	})				   
	return gulp.src(path.build + '**/*.*')		
    	.pipe(plugins.plumber())                                    			
		.pipe(connect.dest('/public_html/beta.miners-moss/wp-content/themes/minersTheme/'))		
		
});

//===============================
gulp.task('default', gulp.series(
  'del',
  gulp.parallel(
	gulp.series('scss'),
	'js',
	'php',
	'img'
	),
	gulp.parallel('deploy','watch')
));
