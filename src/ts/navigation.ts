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
            this.updateURL(route);
        } else {
            fetchPage(route)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    this.pageCache[route] = data[0];
                    this.currentRoute = route;
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
};

Alpine.data('wpApp', () => wpApp);
