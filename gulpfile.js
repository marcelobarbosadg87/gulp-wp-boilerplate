var gulp = require('gulp')
, imagemin = require('gulp-imagemin')
, imageminGifsicle  = require('imagemin-gifsicle')
, imageminJpegtran = require('imagemin-jpegtran')
, imageminOptipng = require('imagemin-optipng')
, imageminSvgo = require('imagemin-svgo')
, clean = require('gulp-clean')
, concat = require('gulp-concat')
, uglify = require('gulp-uglify')
, usemin = require('gulp-usemin')
, cssmin = require('gulp-cssmin')
, sass = require('gulp-sass')
, browserSync = require('browser-sync')
, csslint = require('gulp-csslint')
, autoprefixer = require('gulp-autoprefixer');



// Default Task - tarefa padrão do gulp

gulp.task('default', ['copy'],  function(){

	gulp.start('build-img', 'build-js', 'build-html');

});


// COPY - tarefa para copiar as pastas src para dist

gulp.task('copy', ['clean'] , function(){

	return gulp.src('src/**/*')
	.pipe(gulp.dest('dist'));

});

// CLEAN - tarefa para limpar o diretorio 


gulp.task('clean', function(){
	
	return gulp.src('dist')
	.pipe(clean());
})


// Build IMG - tarefa para minificar as imagens

gulp.task('build-img', function(){

	gulp.src('dist/assets/images/**/*')
	.pipe(

		imagemin([
		
		imagemin.gifsicle({interlaced: true}),
		imagemin.jpegtran({progressive: true, arithmetic: true}),
		imagemin.optipng({optimizationLevel: 2, }),
		imagemin.svgo([{removeViewBox: false}, {minifyStyles: false}])

		], {verbose: true}
		)

		).pipe(gulp.dest('dist/assets/images'));

});

// Build JS - tarefa para concatenar e minificar (uglify) os arquivos js

gulp.task('build-js', function(){

	gulp.src(['src/assets/lib/jquery/jquery-3.1.1.min.js', 'src/assets/js/main.js' ])
	.pipe(concat('all.js'))
	.pipe(uglify())
	.pipe(gulp.dest('dist/assets/js'));

});

// Build HTML - tarefa para substituir os arquivos separados para 1 único arquivo

gulp.task('build-html', function() {

	gulp.src('dist/**/*.html')
	.pipe(htmlReplace({
		js: 'js/all.js'
	}))
	.pipe(gulp.dest('dist'));

});


// Usemin - plugin para facilitar a minificacao

gulp.task('usemin', function (){

	gulp.src('dist/**/*.html')
	.pipe(usemin({
		'js' : [uglify]
		,'css' : [autoprefixer, cssmin]


	}))
	.pipe(gulp.dest('dist'));
});


// SERVER - Browser Sync - sincroniza o browser, pode ser usado com outros servidores - configurar o proxy

gulp.task('server', ['sass', 'copy'], function() {

	browserSync.init({

		server: {
			baseDir: 'src'
		},

		files: 'empresa.html'
	});

	// recarrega o navegador sempre que alguma alteraçao for feita

	gulp.watch('src/**/*')
	.on('change', function() {

		browserSync.reload();


	});

});

gulp.task('sass', function() {
	return gulp.src("src/sass/*.scss")
	.pipe(sass())
	.pipe(gulp.dest("src/css/"))
	.pipe(browserSync.stream());
});