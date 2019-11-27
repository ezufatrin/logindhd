document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {

    // Mock device.platform property if not available
    if (!window.device) {
        window.device = { platform: 'Browser' };
    }

    //var ref = cordova.InAppBrowser.open('https://manfuat.blogspot.com/p/daftar-isi.html', '_self', 'location=no', 'zoom=no')
    var ref = cordova.InAppBrowser.open(url, target, options);

}

function handleExternalURLs() {
    // Handle click events for all external URLs
    if (device.platform.toUpperCase() === 'ANDROID') {
        $(document).on('click', 'a[href^="http"]', function (e) {
            var url = $(this).attr('href');
            //navigator.app.loadUrl(url, { openExternal: true });
            cordova.InAppBrowser.open(url, '_blank', 'location=no', 'zoom=no');
            e.preventDefault();
        });
    }
    else if (device.platform.toUpperCase() === 'IOS') {
        $(document).on('click', 'a[href^="http"]', function (e) {
            var url = $(this).attr('href');
            window.open(url, '_self');
            e.preventDefault();
        });
    }
    else {
        // Leave standard behaviour
    }
}
