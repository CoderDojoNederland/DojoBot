# Description:
#   Deploy CoderDojo Website

module.exports = (robot) ->

	deployAvailable = true

	robot.respond /deploy/i, (msg) ->

		# Check if the user is allowed to deploy
		username = msg.message.user.name
		if 'chris' != username and 'tiemen' != username
			msg.reply 'Sorry, you are not allowed to deploy!'
			return

		# check if a deploy is currently running
		if false == deployAvailable
			msg.reply 'A deploy is currently running'
			return

		# Trigger the deploy
		msg.send "Deploying now!"
		deployAvailable = false

		@exec = require('child_process').exec
		command = "cd Deployment && dep deploy production"

		@exec command, (error, stdout, stderr) ->
			if error
				msg.reply error

			if stdout
				msg.reply 'Deploy successful! :tada:'

			if stderr
				msg.reply stderr

			deployAvailable = true