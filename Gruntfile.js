module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          //style: 'compressed'
        },
        files: {
          'assets/styles/css/style.min.css': 'assets/styles/sass/style.scss',
          'assets/styles/css/editor-style.css': 'assets/styles/sass/editor-style.scss',
        }
      }
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
        ]
      },
      dist: {
        src: 'assets/styles/css/*.css'
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      dist: {
        files: {
          'assets/scripts/dist/script.min.js': 'assets/scripts/src/script.js',
          'assets/scripts/dist/jquery.min.js' : 'assets/scripts/lib/jquery.js',
          'assets/scripts/dist/modernizr.min.js' : 'assets/scripts/lib/modernizr.js',
          'assets/scripts/dist/responsiveslides.min.js' : 'assets/scripts/lib/responsiveslides.js',
          'assets/scripts/dist/holder.min.js' : 'assets/scripts/lib/holder.js'
        }
      }
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
    watch: {
      css: {
        files: 'assets/styles/sass/**/*.scss',
        tasks: ['sass', 'postcss', 'notify:sass']
      },
      scripts: {
        files: ['assets/scripts/src/*.js', 'assets/scripts/lib/*.js'],
        tasks: ['uglify', 'notify:scripts']
      },
      images: {
        files: ['assets/images/src/*.{png,jpg,gif,svg}'],
        tasks: ['imagemin']
      }
    },
    criticalcss: {
      dist: {
        options: {
          url: "http://valley.dev:80",
          width: 1280,
          height: 800,
          outputfile: 'assets/styles/css/critical.css',
          filename: 'assets/styles/css/style.min.css',
          buffer: 800*1024
        }
      }
    },
    notify: {
      notify_hooks: {
        options: {
          enabled: true,
          max_jshint_notifications: 5, // maximum number of notifications from jshint output
          success: true, // whether successful grunt executions should be notified automatically
          duration: 3 // the duration of notification in seconds, for `notify-send` only
        }
      },
      watch: {
        options: {
          title: 'Site built',
          message: 'All files compiled, watching for changes'
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
          message: 'Javascript files compiled, watching for changes'
        }
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-criticalcss');
  grunt.loadNpmTasks('grunt-notify');

  grunt.registerTask('default', [
    'sass',
    'postcss',
    //'criticalcss',
    'uglify',
    'imagemin',
    'notify:watch',
    'watch',
  ]);
}