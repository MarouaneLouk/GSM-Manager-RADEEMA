window.onload = function() {
    if (document.cookie.includes("rememberMe")) {
        document.querySelector('input[name="rememberMe"]').checked = true;
    }
};