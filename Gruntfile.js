module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options:{
          style: 'compressed'
        },
        files: {
          'assets/styles/css/style.css': 'assets/styles/sass/style.scss'
        }
      }
    },
    autoprefixer:{
      dist:{
        files:{
          'assets/styles/css/style.css': 'assets/styles/css/style.css'
        }
      }
    },
    watch: {
      css: {
        files: 'assets/styles/sass/**/*.scss',
        tasks: ['sass', 'autoprefixer']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');

  grunt.registerTask('default', ['sass', 'autoprefixer', 'watch']);
}