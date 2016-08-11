
module.exports = function(grunt) {

	grunt.config('sass', {
		dist: {
			options: {
				style: 'nested'
			},
			files: {
				'public/assets/css/style.css': 'public/assets/sass/style.scss'
			}
		}
  	});

	grunt.loadNpmTasks('grunt-sass');
};

