import { execSync, spawn } from 'child_process';
let version = '0.0.0';
try {
  version = execSync('git describe --tags --abbrev=0', { stdio: ['ignore', 'pipe', 'ignore'] }).toString().trim();
} catch (e) {}
const command = 'npx concurrently -c "#93c5fd,#c4b5fd,#fdba74" "php artisan serve" "php artisan queue:listen --tries=1" "npm run dev" --names=server,queue,vite';
const child = spawn(command, {
  stdio: 'inherit',
  shell: true,
  env: { ...process.env, APP_VERSION: version }
});
child.on('exit', (code) => process.exit(code));