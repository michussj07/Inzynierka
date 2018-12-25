function registerServiceWorker() {
    navigator.serviceWorker
        .register('/service-worker.js')
        .then(registration => {
            console.log(
                "ServiceWorker registered with scope:",
                registration.scope
            );
        })
        .catch(e => console.error("ServiceWorker failed:", e));
}

if (navigator && navigator.serviceWorker) {
    registerServiceWorker();
}