var
	resources = {
		jade : '../resources/jade/',
		sass : '../resources/sass/'
	},
	public = {
		css : '../../public/css/'
	};

var
	jade2html = {
		from : [
			resources.jade + 'modules/index/routineform.jade',
			resources.jade + 'modules/contact/contact.jade'
		]
	}

var
	gulp = require('gulp'),
	jade = require('gulp-jade'),
	sass = require('gulp-sass');

gulp.task('jade', function() {
	return gulp.src([
		resources.jade + '**/*.jade',
		'!' + resources.jade + '_**/*.jade'
	])
	.pipe(jade({
		pretty: true
	}))
	.pipe(gulp.dest(jade2html));
});