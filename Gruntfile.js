"use strict";
module.exports = function(grunt) {

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-kss');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-version');

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    clean: {
      js: [ 'assets/scripts/dist' ],
      sass: [ 'assets/styles/css' ]
    },

    imagemin: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'assets/images/src',
          src: ['**/*.{png,jpg,gif,svg}'],
          dest: 'assets/images/dist'
        }]
      }
    },

    kss: {
      options: {
        template: 'assets/template',
        homepage: 'index.md',
        verbose: true,
        custom: ['Hide'],
        css: '../assets/styles/css/style.<%= pkg.version %>.min.css',
        js: ['../assets/scripts/dist/script.<%= pkg.version %>.min.js', '../assets/scripts/lib/iframify.js'],
      },
      dist: {
        src: ['assets/styles/sass'],
        dest: 'docs',
      }
    },

    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
          require('cssnano')(),
        ]
      },
      dist: {
        src: 'assets/styles/css/*.css'
      }
    },

    sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: {
          'style.css': 'assets/styles/sass/wp-style.scss',
          'assets/styles/css/style.<%= pkg.version %>.min.css': 'assets/styles/sass/style.scss',
          'assets/styles/css/editor-style.<%= pkg.version %>.css': 'assets/styles/sass/editor-style.scss',
          'assets/styles/css/login.<%= pkg.version %>.min.css': 'assets/styles/sass/login.scss',
        }
      }
    },

    uglify: {
      options: {
        mangle: false
      },
      dist: {
        files: {
          'assets/scripts/dist/script.<%= pkg.version %>.min.js':
            [
              'assets/scripts/lib/modernizr.js',
              'assets/scripts/lib/fastclick.js',
              'assets/scripts/lib/picturefill.js',
              'assets/scripts/lib/responsiveslides.js',
              'assets/scripts/src/script.js'
            ],
          'assets/scripts/dist/script.rewrite.<%= pkg.version %>.min.js':
            [
              'assets/scripts/lib/modernizr.js',
              'assets/scripts/lib/fastclick.js',
              'assets/scripts/lib/picturefill.js',
              'assets/scripts/lib/responsiveslides.js',
              'assets/scripts/src/script.rewrite.js'
            ],
          'assets/scripts/dist/jquery.min.js': 'assets/scripts/lib/jquery.js',
          'assets/scripts/dist/rem.min.js' : 'assets/scripts/lib/rem.js',
          'assets/scripts/dist/respond.min.js' : 'assets/scripts/lib/respond.js',
        }
      }
    },

    version: {
      php: {
        options: {
          prefix: '\'VC_THEME_VERSION\', \''
        },
        src: [ 'functions.php' ]
      },
      js: {
        options: {
          prefix: 'version: \''
        },
        src: [ 'assets/scripts/src/script.js' ]
      },
      jsnew: {
        options: {
          prefix: 'Version: \''
        },
        src: [ 'assets/scripts/src/script.rewrite.js' ]
      },
      sass: {
        options: {
          prefix: 'Version: '
        },
        src: [ 'assets/styles/sass/_theme-info.scss' ]
      },
      md: {
        options: {
          prefix: '## Version '
        },
        src: [ 'README.md' ]
      }
    },

    watch: {
      options: {
        livereload: true,
      },
      css: {
        files: ['assets/styles/sass/**/*.scss', 'assets/styles/sass/styleguide.md', 'assets/template/*.html'],
        tasks: ['sass', 'postcss', 'kss', 'notify:sass'],
      },
      scripts: {
        files: ['assets/scripts/src/*.js', 'assets/scripts/lib/*.js'],
        tasks: ['uglify', 'notify:scripts']
      },
      images: {
        files: 'assets/images/src/*.{png,jpg,gif,svg}',
        tasks: ['imagemin', 'notify:images']
      },
    },

    notify: {
      notify_hooks: {
        options: {
          enabled: true,
          success: true,
          duration: 3
        }
      },
      local: {
        options: {
          title: 'Local site built',
          message: 'All files compiled, watching for changes'
        }
      },
      build: {
        options: {
          title: 'Site built (v<%= pkg.version %>)',
          message: 'All files compiled and version number bumped'
        }
      },
      sass: {
        options: {
          title: 'Sass compiled',
          message: 'Sass files compiled, watching for changes'
        }
      },
      scripts: {
        options: {
          title: 'Scripts compiled',
          message: 'JavaScript files compiled, watching for changes'
        }
      },
      images: {
        options: {
          title: 'Images minified',
          message: 'Image files minified, watching for changes'
        }
      },
    }
  });

  grunt.registerTask('local', [
    'sass',
    'postcss',
    'uglify',
    'imagemin',
    'kss',
    'notify:local',
    'watch',
  ]);

  grunt.registerTask('default', [
    'local'
  ]);

  grunt.registerTask('build', [
    'clean',
    'version',
    'sass',
    'postcss',
    'uglify',
    'imagemin',
    'kss',
    'notify:build',
  ]);
};
