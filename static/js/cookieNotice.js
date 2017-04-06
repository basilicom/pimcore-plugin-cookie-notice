window.onload = function () {
    var cookieName = 'cookiesAllowed';

    var splitted = document.cookie.split(';');
    var cookieFound = false;
    for(var i = 0; i < splitted.length; i++) {
        if(splitted[i].trim() == cookieName + '=1') {
            cookieFound = true;
            break;
        }
    }

    if(!cookieFound) {
        var cookieNotice = document.createElement('div');
        cookieNotice.setAttribute('class', 'cookieNotice');

        var cookieNoticeButton = document.createElement('div');
        cookieNoticeButton.setAttribute('class', 'cookieNotice__button');
        cookieNoticeButton.innerHTML = typeof(COOKIE_NOTICE_BUTTON) !== 'undefined' && COOKIE_NOTICE_BUTTON != '' ? COOKIE_NOTICE_BUTTON : 'Cookies&nbsp;erlauben';

        cookieNoticeButton.addEventListener('click', function () {
            var days = 30;
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = cookieName + "=1; expires=" + date.toUTCString();
            var notice = document.getElementsByClassName('cookieNotice')[0];
            notice.parentNode.removeChild(notice);
        });

        var cookieNoticeText = document.createElement('div');
        cookieNoticeText.setAttribute('class', 'cookieNotice__text');
        cookieNoticeText.innerHTML = typeof(COOKIE_NOTICE_TEXT) !== 'undefined' && COOKIE_NOTICE_TEXT != '' ? COOKIE_NOTICE_TEXT : 'Diese Internetseite verwendet Cookies, um die Nutzererfahrung zu verbessern und den Benutzern bestimmte Dienste und Funktionen bereitzustellen.';

        cookieNotice.append(cookieNoticeText);
        cookieNotice.append(cookieNoticeButton);

        document.body.append(cookieNotice);
    }
}

