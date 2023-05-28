import Alpine from 'alpinejs';

declare global {
    interface Window {
        Alpine:typeof Alpine;
    }
}

/**
 * Load Alpine after window load
 */
window.onload = function () {
    window.Alpine = Alpine;
    Alpine.start();
};
