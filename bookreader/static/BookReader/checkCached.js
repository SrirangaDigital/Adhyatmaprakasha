var storage = window.localStorage;
if (!storage.cachedElements) {
    storage.cachedElements = "";
}

function logCache(source) {
    if (storage.cachedElements.indexOf(source, 0) < 0) {
        if (storage.cachedElements != "") 
            storage.cachedElements += ";";
        storage.cachedElements += source;
    }
}

//On DOM Ready
$(document).ready(function() {
    plImages = $(".BRnoselect");
	//log cached images
    plImages.bind('load', function() {
        logCache($(this).attr("src"));
    });
});
