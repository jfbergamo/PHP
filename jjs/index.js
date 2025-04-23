async function main() {
    document.title = "Gardonio";
    setFavicon('favicon.ico');
    linkCSS('https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css');
    addBodyScript('https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js');
    addHTMLAttribute('data-bs-theme', 'dark');

    return JForm({},
        (data) => {
            fetch('/api/add_user', {
                method: "POST",
                body: JSON.stringify(data)
            }).then(() => )
        },
        input({
            type: "hidden",
            name: "pippo",
            value: "luca camilotti"
        }),
        button({
            type: "submit",
        }, "Invia")
    );
}