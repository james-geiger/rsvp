import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs'
import { resolve } from 'path'
import { homedir } from 'os'

export default defineConfig(({ command, mode }) => {
	// Load current .env-file
	const env = loadEnv(mode, process.cwd(), '')

	let serverConfig = {}
  
	if (env.APP_ENV === 'local'){
		// Set the host based on APP_URL
		let host = new URL(env.APP_URL).host
		let homeDir = homedir()
	
		if (homeDir) {
		serverConfig = {
			https: {
			key: fs.readFileSync(
				resolve(homeDir, `.config/valet/Certificates/${host}.key`),
			),
			cert: fs.readFileSync(
				resolve(homeDir, `.config/valet/Certificates/${host}.crt`),
			),
			},
			hmr: {
			host
			},
			host
		}
		}
	}
  
	return {
	  plugins: laravel({
		input: [
			'resources/css/app.css',
			'resources/js/app.js',
		],
		refresh: true,
	}),
	  server: serverConfig
	}
  });
