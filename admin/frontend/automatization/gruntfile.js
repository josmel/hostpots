var
    resources = {
        jade: {
            //layout
            '../../../source/resources/views/admin/_layouts/layout.blade.php': '../resources/jade/layout/layout.jade',
            '../../../source/resources/views/admin/_layouts/layout_remenber.blade.php': '../resources/jade/layout/layout_remenber.jade',

            '../../../source/resources/views/admin/auth/login.blade.php': '../resources/jade/modules/login/index.jade',

            '../../../source/resources/views/admin/home/index.blade.php': '../resources/jade/modules/home/index.jade',
            '../../../source/resources/views/admin/home/form.blade.php': '../resources/jade/modules/home/form.jade',
            '../../../source/resources/views/admin/home/list.blade.php': '../resources/jade/modules/home/list.jade',


            '../../../source/resources/views/admin/user/form.blade.php': '../resources/jade/modules/user/form.jade',
            '../../../source/resources/views/admin/user/list.blade.php': '../resources/jade/modules/user/list.jade',

            '../../../source/resources/views/admin/remenber/mail.blade.php': '../resources/jade/modules/remenber/mail.jade',
            '../../../source/resources/views/admin/remenber/form.blade.php': '../resources/jade/modules/remenber/form.jade',

            '../../../source/resources/views/admin/profile/index.blade.php': '../resources/jade/modules/profile/index.jade'

        },
        coffee: '../resources/coffee/'
    },
    public = {
        css: '../../../source/public/static/css/',
        js: '../../../source/public/static/js/'
    };


module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt)
    grunt.initConfig({
        jade: {
            compile: {
                options: {
                    pretty: true,
                },
                files: resources.jade
            }
        },
        compass: {
            dev: {
                options: {
                    sassDir: ['../resources/sass'],
                    cssDir: ['../../source/public/static/css'],
                    imagesDir: ['../../resources/assets/img/'],
                    environment: 'development'
                }
            },
            prod: {
                options: {
                    sassDir: ['../resources/sass'],
                    cssDir: ['../../resources/cssPro'],
                    environment: 'production'
                }
            }
        },
        sprite: {
            all: {
                src: '../resources/assets/sprites/*.png',
                destImg: '../../../source/public/static/img/icon-set.png',
                cssFormat: 'stylus',
                destCSS: '../resources/stylus/utilities/_mixins/sprite.styl'
            }
        },
        webfont: {
            icons: {
                src: '../resources/assets/fonticon/*.svg',
                dest: '../../../source/public/static/css/fonts/icons',
                destCss: '../resources/stylus/utilities/_mixins',
                options: {
                    //destHtml: 'source/',
                    hashes: false,
                    engine: 'node',
                    autoHint: false,
                    styles: 'icon',
                    //fontHeight: 1,
                    stylesheet: 'styl',
                    font: 'icons',
                    templateOptions: {
                        baseClass: 'icon',
                        classPrefix: 'icon-'
                    }
                }
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: '../resources/assets/img',
                    src: ['**/**/*.{png,jpg,gif}'],
                    dest: '../../../source/public/static/img'
                }]
            }
        },
        coffee: {
            glob_to_multiple: {
                expand: true,
                cwd: resources.coffee,
                src: ['**/*.coffee'],
                dest: public.js,
                ext: '.js'
            }
        },
        sass: {
            options: {
                indentedSyntax: true,
                sourceMap: true
            },
            dist: {
                files: {
                    '../../../source/public/static/css/index.css': '../resources/sass/index.sass'
                }
            }
        },
        stylus: {
            compile: {
                files: {
                    '../../../source/public/static/css/all.css': '../resources/stylus/all.styl'
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

    grunt.registerTask('default', 'se ha cambiado el archivo', ['compass:dev', 'watch'])
    grunt.registerTask('prod', ['compass:prod'])
    grunt.registerTask('img', ['imagemin'])
};