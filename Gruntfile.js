module.exports = (grunt) => {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      js: {
        files: 'src/js/*.js',
        tasks: ['js']
      },
      css: {
        files: ['src/css/style.css'],
        tasks: ['css']
      }
    },
    clean: {
      mincss: {
        src: ['public_html/css/style.min.css']
      },
      revcss: {
        src: ['public_html/css/*style.min.css']
      },
      revjs: {
        src: ['public_html/js/*martinjoiner.min.js']
      },
      concatjs: {
        src: ['public_html/js/concatinated.js']
      },
    },
    jshint: {
      options: {
        asi: true,
        curly: true,
        eqeqeq: true,
        eqnull: true,
        browser: true,
        varstmt: true,
        esversion: 6
      },
      all: ['Gruntfile.js', 'src/js/*.js']
    }, 
    concat: {
      js: {
        src: 'src/js/*.js',
        dest: 'public_html/js/concatinated.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        src: 'public_html/js/concatinated.js',
        dest: 'public_html/js/martinjoiner.min.js'
      }
    },
    cssmin: {
      mj: {
        files: {
          'public_html/css/style.min.css': ['src/css/style.css']
        }
      }
    },
    rev: {
      css: {
        files: {
          src: ['public_html/css/style.min.css']
        }
      },
      js: {
        files: {
          src: ['public_html/js/martinjoiner.min.js']
        }
      }
    },
    injector: {
      options: { "ignorePath": ['public_html'] },
      css: {
        files: {
          'src/_includes/main.njk': ['public_html/css/*style.min.css'],
        }
      },
      js: {
        files: {
          'src/_includes/main.njk': ['public_html/js/*martinjoiner.min.js'],
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-rev');
  grunt.loadNpmTasks('grunt-injector');

  // Default task(s).
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('js', ['clean:revjs','jshint','concat','uglify','rev:js','injector:js','clean:concatjs']);
  grunt.registerTask('css', ['clean:mincss','clean:revcss','cssmin:mj','rev:css','injector:css']);
};
