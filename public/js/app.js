$(function() {
    // Remove stored token on logout
    $("#navbar .logout").click(function(e) {
        delete localStorage.api_token;
    });
});

function factory(item) {
    return $("#factory ." + item).clone();
}

function modalFade(enableFade) {
    $(".modal, .modal-backdrop").toggleClass("fade", enableFade);
}

function loadModal(modal, url, showModal) {
    if (typeof showModal == "undefined") showModal = true;
    
    var $modal = $(modal);
    var $content = $modal.find(".content-loadable");
    
    console.log("load modal: %o %o", modal, url);
    
    // Load modal
    $content.LoadingOverlay("show", modal_LoadingOverlay);
    $content.load(url, function() {
        $content.LoadingOverlay("hide");
    });
    
    // Show modal
    if (showModal) $modal.modal();
}

function formatDate(date) {
    return moment.utc(date).local().calendar();
}