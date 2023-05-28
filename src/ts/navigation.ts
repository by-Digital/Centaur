import Alpine from 'alpinejs';
import { getCurrentSlug, fetchPage } from './wordpress/functions';

const wpApp = {
    currentRoute: '',
    data: {},
    pageCache: {},

    init() {
        this.currentRoute = getCurrentSlug();
        this.loadPage(this.currentRoute);
    },

    loadPage(route: string) {
        route = route.replace(/\/$/, '').split('/').pop();
        route = route == '' ? '/' : route;

        if (this.pageCache[route]) {
            this.currentRoute = route;
            this.data = this.pageCache[route];
            this.updateURL(route);
        } else {
            fetchPage(route)
                .then((response) => response.json())
                .then((data) => {
                    this.pageCache[route] = data[0];
                    this.currentRoute = route;
                    this.data = data[0];
                    this.updateURL(route);
                });
        }

    },

    updateURL(route: string) {
        //* Get current route
        const url = route[0] != '/' ? `/${route}` : route;
        const locPath = window.location.pathname;

        //* Workout current location
        let pathname = locPath.replace(/\/$/, '');
        pathname = (pathname == '') ? '/' : '/' + pathname.split('/').pop();

        //* If then Push
        if (pathname != url) {
            window.history.pushState(null, null, url);
        }
    },

    currData() {
        return this.currStore;
    },
};

Alpine.data('wpApp', () => wpApp);

document.addEventListener('alpine:init', async () => {
    Alpine.store('post', wpApp);
})
