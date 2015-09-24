'use strict';
module.exports = function(grunt) {

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-postcss');

  grunt.initConfig({
    sass: {
      development: {
        options: {
          style: 'compressed',
          lineNumbers: false,
        },
        files: {
          'style.css': 'assets/styles/sass/style.scss',
          //'assets/styles/css/style.min.css': 'assets/styles/sass/style.scss',
        }
      },
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')
        ]
      },
      development: {
        src: 'style.css',
      }
    },
    uglify: {
      options: {
        //beautify: true,
        sourceMap: true,
        sourceMapName: 'assets/scripts/dist/site.min.map'
      },
      development: {
        files: {
          'assets/scripts/dist/site.min.js': ['assets/scripts/lib/jquery.js', 'assets/scripts/lib/fastclick.js', 'assets/scripts/lib/html5shiv.js', 'assets/scripts/src/site.js']
        }
      },
    },
    jshint: {
      files: [
        'assets/scripts/src/site.js'
      ],
      options: {
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },
    watch: {
      sass: {
        files: ['assets/styles/css/style.css', 'assets/styles/sass/**/*.scss'],
        tasks: ['sass']
      },
      postcss: {
        files: ['assets/styles/css/*.css'],
        tasks: ['postcss']
      },
      uglify: {
        files: ['assets/scripts/src/*.js', 'assets/scripts/lib/*.js'],
        tasks: ['uglify'],
        options: {
          livereload: true
        }
      },
      css: {
        files: '**/*.css',
        options: {
          livereload: true
        }
      },
      html: {
        files: ['*.html', '*.php', '**/*.css', '!node_modules/**'],
        options: {
          livereload: true
        }
      }
    },
    connect: {
      server: {
        options: {
          hostname: '*',
          livereload: true,
          open: {
            target: 'http://127.0.0.1:8000/'
          },
          port: 8000,
        }
      }
    }
  });

  grunt.registerTask('default', [
    //'connect',
    'sass',
    'postcss',
    'uglify',
    'watch'
  ]);
}