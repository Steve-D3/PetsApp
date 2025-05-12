import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Livewire is already included by @livewireScripts in your blade file
// We just need to make sure it's available before using it
window.deferLoadingAlpine = function (callback) {
    if (window.Livewire) {
        callback();
    } else {
        window.addEventListener('livewire:load', callback);
    }
};
