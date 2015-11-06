module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          style: 'nested'
        },
        files: {
          'assets/styles/css/style.min.css': 'assets/styles/sass/style.scss'
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
        src: 'assets/styles/css/style.min.css'
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      dist: {
        files: {
          'assets/scripts/dist/script.min.js':
            [
              'assets/scripts/lib/jquery.js',
              'assets/scripts/lib/modernizr.js',
              'assets/scripts/lib/holder.js',
              'assets/scripts/src/script.js',
            ]
        }
      }
    },
    watch: {
      css: {
        files: 'assets/styles/sass/**/*.scss',
        tasks: ['sass', 'postcss']
      },
      scripts: {
        files: 'assets/scripts/**/*.js',
        tasks: ['uglify']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');

  grunt.registerTask('default', ['sass', 'postcss', 'uglify', 'watch']);
}