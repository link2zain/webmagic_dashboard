export function getLocale() {
    try {
        return JSON.parse($('#data-locale').html());
    } catch (err){
        return {locale:'en'};
    }
}
