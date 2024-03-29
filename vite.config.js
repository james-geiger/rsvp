import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs'
import { resolve } from 'path'
import { homedir } from 'os'

export default defineConfig(({ command, mode }) => {
	// Load current .env-file
	const env = loadEnv(mode, process.cwd(), '')

	let serverConfig = {}

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
