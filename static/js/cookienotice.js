var CookieNotice = function(text, label, lifetime) {

    var cookieName = 'cookie-notice-accepted',
        $wrapper,
        $wrapperInner,
        $textContainer,
        $button,

        init = function() {
            var splitted = document.cookie.split(';'),
                cookieFound = false;

            for (var i = 0; i < splitted.length; i++) {
                if (splitted[i].trim() == cookieName + '=1') {
                    cookieFound = true;
                    break;
                }
            }
            if (!cookieFound) {
                createElements();
            }
        },

        createElements = function() {
            $wrapper = document.createElement('div');
            $wrapper.setAttribute('class', 'cookie-notice');
            $wrapper.setAttribute('id', 'cookieNotice');

            $wrapperInner = document.createElement('div');
            $wrapperInner.setAttribute('class', 'cookie-notice__inner');

            $textContainer = document.createElement('div');
            $textContainer.setAttribute('class', 'cookie-notice__text');
            $textContainer.innerHTML = text;

            $button = document.createElement('div');
            $button.setAttribute('class', 'cookie-notice__button');
            $button.innerHTML = label;
            $button.addEventListener('click', onButtonClick);
            
            $wrapper.append($wrapperInner);
            $wrapperInner.append($textContainer);
            $wrapperInner.append($button);

            document.body.append($wrapper);
        },

        onButtonClick = function(e) {
            var days = (lifetime && parseInt(lifetime) > 0) ? parseInt(lifetime) : 30,
                date = new Date();

            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = cookieName + "=1; expires=" + date.toUTCString();
            $wrapper.parentNode.removeChild($wrapper);
        };

    window.onload = function() {
        init();    
    };
};

// Source: https://github.com/jserz/js_piece/blob/master/DOM/ParentNode/append()/append().md
(function (arr) {
    arr.forEach(function (item) {
        if (item.hasOwnProperty('append')) {
            return;
        }
        Object.defineProperty(item, 'append', {
            configurable: true,
            enumerable: true,
            writable: true,
            value: function append() {
                var argArr = Array.prototype.slice.call(arguments),
                    docFrag = document.createDocumentFragment();

                argArr.forEach(function (argItem) {
                    var isNode = argItem instanceof Node;
                    docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
                });

                this.appendChild(docFrag);
            }
        });
    });
})([Element.prototype, Document.prototype, DocumentFragment.prototype]);