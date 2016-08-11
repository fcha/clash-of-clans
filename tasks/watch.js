
module.exports = function(grunt) {

	grunt.config('watch', {
		sass: {
			files: [
				'public/assets/sass/**/*.scss',
				'resources/views/**/*.scss',
			],
			tasks: ['sass']
		}
  	});

	grunt.loadNpmTasks('grunt-contrib-watch');
};