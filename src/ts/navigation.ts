import Alpine from 'alpinejs';
import { getCurrentSlug, fetchPage } from './wordpress/functions';

const wpApp = {
    currentRoute: '',
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
        } else {
            fetchPage(route)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    this.pageCache[route] = data[0];
                    this.currentRoute = route;
                });
        }

        this.updateURL(route);
    },

    updateURL(route: string) {
        const url = route[0] != '/' ? `/${route}` : route;
        console.log('url', url);
        window.history.replaceState(null, null, url);
    },
};

Alpine.data('wpApp', () => wpApp);
