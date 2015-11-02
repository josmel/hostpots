var
	path = {
		jade : 'resources/assets/jade/',
		stylus : 'resources/assets/stylus/modules/',
		coffee : 'resources/assets/coffee/',
		static : {
			img : 'resources/assets/static/img/'
		}
	},
	public = {
		css : 'public/css/',
		img : 'public/img/'
	};

var
	gulp = require('gulp'),
	stylus = require('gulp-stylus'),
	cssVersioner = require('gulp-css-url-versioner'),
	plumber = require('gulp-plumber'),
	imagemin = require('gulp-imagemin'),
	elixir = require('laravel-elixir'),
	runSequence = require('run-sequence'),
	notifier = require('node-notifier');

require('laravel-elixir-jade');

elixir( function(mix) {
	mix
		.jade({
			baseDir: './resources',
	    blade: true,
	    dest: '/views/',
	    pretty: true,
	    search: '**/*.jade',
	    src: '/assets/jade/modules/'
		})
		.coffee();
});

gulp.task('stylus', function() {
	return gulp.src([
		path.stylus + '**/*.styl',
		path.stylus + '**/**/*.styl',
		'!' + path.stylus + '_**/*.styl',
		'!' + path.stylus + '**/_**/*.styl'
	])
	.pipe(plumber())
	.pipe(stylus({
		compress: true
	}))
	.pipe(cssVersioner())
	.pipe(gulp.dest(public.css));
});

gulp.task('img', function() {
	return gulp.src([
		path.static.img + '*'
	])
	.pipe(imagemin())
	.pipe(gulp.dest(public.img));
});

gulp.task('watch', function() {
  gulp.watch([
  	path.jade + '**/*.jade',
  	path.jade + '_**/*.jade',
  	path.jade + '**/**/*.jade'
  ], ['jade']);

  gulp.watch([
  	path.stylus + '**/*.styl',
  	path.stylus + '_**/*.styl',
  	path.stylus + '**/**/*.styl'
  ], ['stylus']);

  gulp.watch([
  	path.coffee + '**/*.coffee',
  	path.coffee + '**/**/*.coffee'
  ], ['coffee']);
});

gulp.task('default', function (cb) {
    runSequence('jade', 'stylus', 'coffee', 'img', function () {
    	notifier.notify({
  			title: 'Gulp Default',
  			message: 'Every task has been run satisfactory',
  			sound: true
			});
    });
});