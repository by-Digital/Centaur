export function fetchPage(slug: string) {
    if (slug == '/') {
        return fetch(`/wp-json/wp/v2/pages/frontpage`);
    } else {
        return fetch(`/wp-json/wp/v2/pages?slug=${slug}`);
    }
}
