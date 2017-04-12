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

        var cookieNoticeInner = document.createElement('div');
        cookieNoticeInner.setAttribute('class', 'cookieNotice__inner');
        
        var cookieNoticeButton = document.createElement('div');
        cookieNoticeButton.setAttribute('class', 'cookieNotice__button');
        cookieNoticeButton.innerHTML = typeof(COOKIE_NOTICE_BUTTON) !== 'undefined' && COOKIE_NOTICE_BUTTON != '' ? COOKIE_NOTICE_BUTTON : 'Cookies&nbsp;erlauben';

        cookieNoticeButton.addEventListener('click', function () {
            var days = typeof(COOKIE_NOTICE_DAYS) != 'undefined' && parseFloat(COOKIE_NOTICE_DAYS) > 0 ? parseFloat(COOKIE_NOTICE_DAYS) : 30;
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = cookieName + "=1; expires=" + date.toUTCString();
            var notice = document.getElementsByClassName('cookieNotice')[0];
            notice.parentNode.removeChild(notice);
        });

        var cookieNoticeText = document.createElement('div');
        cookieNoticeText.setAttribute('class', 'cookieNotice__text');
        cookieNoticeText.innerHTML = typeof(COOKIE_NOTICE_TEXT) !== 'undefined' && COOKIE_NOTICE_TEXT != '' ? COOKIE_NOTICE_TEXT : 'Diese Internetseite verwendet Cookies, um die Nutzererfahrung zu verbessern und den Benutzern bestimmte Dienste und Funktionen bereitzustellen.';
        
        cookieNoticeInner.append(cookieNoticeText);
        cookieNoticeInner.append(cookieNoticeButton);
        cookieNotice.append(cookieNoticeInner);

        document.body.append(cookieNotice);
    }
}

