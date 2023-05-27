export function getCurrentSlug() {
    const path = window.location.pathname;
    const slug = path.replace(/\/$/, '').split('/').pop();
    return slug == '' ? '/' : slug;
}
