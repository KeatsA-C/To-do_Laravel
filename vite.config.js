// vite.config.js
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: false, // disable default refresh to avoid conflicts
    }),
    livewire({
      refresh: [
        ...refreshPaths,
        'app/Http/Livewire/**',
        'resources/views/livewire/**',
      ],
    }),
  ],
});
