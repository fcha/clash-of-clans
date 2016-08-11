
module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json')
	});

	//load npm and any external tasks
	grunt.loadTasks('tasks');

	// Default task(s).
	grunt.registerTask('default', ['sass']);
};
