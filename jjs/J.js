// J.js

// =================================== HTML COMPONENTS ===================================

const _getChild = (child) => ['string', 'number'].includes(typeof child) ? document.createTextNode(child) : child;

function _createHTMLComponent(name, attr, ...children) {
    const comp = document.createElement(name);

    for (const key in attr) {
        if (key === 'JEvents') {
            const events = attr[key];
            for (const event in events) {
                comp.addEventListener(event, events[event]);
            }
        } else {
            comp.setAttribute(key, attr[key]);
        }
    }

    children.forEach((child) => comp.appendChild(_getChild(child)));

    return comp;
}

const addHTMLAttribute = (name, value) => document.lastChild.setAttribute(name, value)

function setFavicon(href) {
    const favicon = document.createElement('link');
    favicon.setAttribute('rel', 'icon');
    favicon.setAttribute('type', 'image/x-icon');
    favicon.setAttribute('href', href);
    document.head.appendChild(favicon);
}

function linkCSS(href) {
    const style = document.createElement('link');
    style.setAttribute('rel', 'stylesheet');
    style.setAttribute('href', href);
    document.head.appendChild(style);
}

function addHeadScript(src) {
    const script = document.createElement('script');
    script.setAttribute('src', src);
    document.head.appendChild(script);
}

function addBodyScript(src) {
    const script = document.createElement('script');
    script.setAttribute('src', src);
    root.after(script);
}

// =================================== SPECIAL J.js FUNCTIONS ===================================

function JRouter(routes) {
    const content = div({class: "jrouter"});
    
    const callback = function() {
        const path = location.hash.split('#')[1] ?? (() => location.hash = '/')();

        content.innerHTML = '';
        if (Object.keys(routes).includes(path)) {
            content.appendChild(_getChild(routes[path]));
        } else {
            content.appendChild(
                div({'class': 'container text-center mt-4'},
                    div({'class': 'alert alert-danger'},
                        h1({}, "404"),
                        "La pagina che cerchi non esiste!"
                    )
                )
            );
        }
    }

    callback();
    window.onhashchange = callback;

    return content;
}

function JState(firstState) {
    const statefulDiv = div({class: 'j-stateful-div'}, firstState);

    return [statefulDiv, (state) => {
        statefulDiv.innerHTML = '';
        statefulDiv.appendChild(_getChild(state));
    }];
}

function JForm(attributes, onsubmit, ...children) {
    return form({
        JEvents: {
            submit: function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const data = {};
                for (const [key, value] of formData) {
                    data[key] = value;
                }
                onsubmit(data);
            }
        },
        ...attributes
    }, ...children);
}

window.addEventListener('load', () => main().then((data) => root.appendChild(data)))

// =================================== HTML COMPONENT ABSTRACTIONS ===================================

const div = (attributes, ...children) => _createHTMLComponent('div', attributes, ...children);

const h1 = (attributes, ...children) => _createHTMLComponent('h1', attributes, ...children);

const h2 = (attributes, ...children) => _createHTMLComponent('h2', attributes, ...children);

const form = (attributes, ...children) => _createHTMLComponent('form', attributes, ...children);

const input = (attributes) => _createHTMLComponent('input', attributes);

const button = (attributes, ...children) => _createHTMLComponent('button', attributes, ...children);

const a = (attributes, ...children) => _createHTMLComponent('a', attributes, ...children);

const p = (attributes, ...children) => _createHTMLComponent('p', attributes, ...children);

const br = () => _createHTMLComponent('br');

const hr = () => _createHTMLComponent('hr');

function img(src, attributes) {
    return _createHTMLComponent('img', {
        src: src,
        ...attributes
    })
}