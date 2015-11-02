var
	resources = {
		jade : {
			'../../../source/resources/views/client/welcome/index.blade.php': '../resources/jade/modules/index/index.jade',
			'../../../source/resources/views/client/solicitar/index.blade.php': '../resources/jade/modules/solicitar/index.jade',
			'../../../source/resources/views/client/activos/index.blade.php': '../resources/jade/modules/activos/index.jade',
			'../../../source/resources/views/client/activos/detalle.blade.php': '../resources/jade/modules/activos/detalle.jade',
			'../../../source/resources/views/client/activos/excel.blade.php': '../resources/jade/modules/activos/excel.jade',
			'../../../source/resources/views/client/completados/index.blade.php': '../resources/jade/modules/completados/index.jade',
			'../../../source/resources/views/client/completados/detalle.blade.php': '../resources/jade/modules/completados/detalle.jade',
			'../../../source/resources/views/client/perfil/index.blade.php': '../resources/jade/modules/perfil/perfil.jade',
			'../../../source/resources/views/client/analytics/index.blade.php': '../resources/jade/modules/analytics/index.jade',
			'../../../source/resources/views/client/soporte/index.blade.php': '../resources/jade/modules/soporte/index.jade',
		},
		sass : '../resources/sass/',
		coffee: '../resources/coffee/'
	},
	public = {
		css : '../../../source/public/client/css/',
		js: '../../../source/public/client/js/'
	};

module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt)
	grunt.initConfig({
		jade: {
			compile : {
				options : {
					pretty : true,
				},
				files : resources.jade
			}
		},
		compass: {
			dev: {
				options: {
					sassDir: ['../resources/sass'],
					cssDir: ['../../public/css'],
					imagesDir: ['../../resources/assets/img/'],
					environment: 'development'
				}
			},
			prod:{
				options: {
					sassDir: ['../resources/sass'],
					cssDir: ['../../resources/cssPro'],
					environment: 'production'
				}
			}
		},
		sprite:{
			all:{
				src: '../resources/assets/sprites/*.png',
				destImg: '../../../source/public/client/img/icon-set.png',
				cssFormat: 'stylus',
				destCSS: '../resources/stylus/utilities/_mixins/sprite.styl'
			}
		},
        webfont:{
            icons:{
                src: '../resources/assets/fonticon/*.svg',
                dest: '../../../source/public/client/css/fonts/icons',
                destCss: '../resources/stylus/utilities/_mixins',
                options:{
                    //destHtml: 'source/',
                    hashes: false,
                    engine: 'node',
                    autoHint:false,
                    styles: 'icon',
                    //fontHeight: 1,
                    stylesheet: 'styl',
                    font: 'icons',
                    templateOptions:{
                        baseClass: 'icon',
                        classPrefix: 'icon-'
                    }
                }
            }
        },
        imagemin:{
        	dynamic: {
        		files: [{
        			expand: true,
        			cwd: '../resources/assets/img',
        			src: ['*.{png,jpg,gif}'],
        			dest: '../../../source/public/client/img'
        		}]
        	}
        },
        coffee:{
			glob_to_multiple: {
				expand: true,
				cwd: resources.coffee,
				src: ['**/*.coffee'],
				dest: public.js,
				ext: '.js'
			}
        },
		sass:{
			options:{
				indentedSyntax: true,
				sourceMap: true
			},
			dist:{
				files:{
					'../../public/css/index.css': '../resources/sass/index.sass'
				}
			}
		},
		stylus: {
			compile: {
				files: {
					'../../../source/public/client/css/all.css':'../resources/stylus/all.styl'
				}
			}
		},
		watch: {
			stylus: {
				files: '../resources/stylus/**/**/*.styl',
				tasks: ['stylus']
			},
			jade: {
				files: '../resources/jade/**/**/*.jade',
				tasks: ['jade']
			},
			coffee: {
				files: '../resources/coffee/**/**.coffee',
				tasks: ['coffee']
			}
		}


	});

	// grunt.loadNpmTasks('grunt-sass');
	// grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-webfont');
    grunt.loadNpmTasks('grunt-spritesmith');
	//grunt.loadNpmTasks('grunt-contrib-imagemin');

	grunt.registerTask('default','se ha cambiado el archivo',['compass:dev','watch'])
	grunt.registerTask('prod',['compass:prod'])
	grunt.registerTask('img', ['imagemin'])
};