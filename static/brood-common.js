document.addEventListener('alpine:init', () => {
    Alpine.store('htmx', {
        is_swapping: false,
        is_snapshotting: false,

        /**
         * Helper to deconflict alpine transitions with htmx push url swaps
         */
        async await_snapshot() {
            // wait 50ms for htmx to potentially snapshot
            await new Promise(r => setTimeout(r, 50));
            
            while (this.is_snapshotting) {
                //console.log('waiting some morez...');
                await new Promise(r => setTimeout(r, 50));
            }
            
            return new Promise(r => r());
        },
    });

    document.addEventListener('htmx:beforeHistorySave', () => {
        Alpine.store('htmx').is_snapshotting = true;
    });

    document.addEventListener('htmx:pushedIntoHistory', () => {
        Alpine.store('htmx').is_snapshotting = false;
    });

    document.addEventListener('htmx:historyRestore', () => {
        Alpine.store('htmx').is_snapshotting = false;
    });

    Alpine.store('ui', {
        is_mobile: false, 
        mobile_keyboard_active: false,
        show_main_bar: true,
        show_user_bar: true,
        active_main_bar_menu: 'groups',

        init() {
            this.is_mobile = !window.matchMedia('(min-width: 1024px)').matches;
            this.show_main_bar = !this.is_mobile;
            this.show_main_bar = !this.is_mobile;
        }
    });

    Alpine.data('side_bar', () => ({
        open: true,

        init() {
            this.open = !Alpine.store("ui").is_mobile;
        },
        show() {
            this.open = true;
        },
        hide() {
            this.open = false;
        },
        toggle() {
            this.open = !this.open;
        },
        click_away() {
            if (Alpine.store('ui').is_mobile && this.open) {
                Alpine.store('htmx').await_snapshot().then(() => {
                    this.open = false;
                });
            }
        },
    }));

    Alpine.data('dropdown', () => ({
        open: false,

        toggle() {
            this.open = !this.open;
        },
        click_away() {
            if (this.open) {
                Alpine.store('htmx').await_snapshot().then(() => {
                    this.open = false;
                });
            }
        }
    }));

    Alpine.data('editor', () => ({
        open: false,

        show() {
            this.open = true;
        },
        hide() {
            this.open = false;
        },
        toggle() {
            this.open = !this.open;
        },
        click_away() {
            if (this.open) {
                Alpine.store('htmx').await_snapshot().then(() => {
                    this.open = false;
                });
            }
        }
    }));

    Alpine.data('modal', () => ({
        open: false,

        show() {
            this.open = true;
        },

        close() {
            this.open = false;
        },
    }));

    Alpine.data('text_field', () => ({
        active: false,
        focus() {
            //Alpine.store('ui').mobile_keyboard_active = Alpine.store('ui').is_mobile;
        },
        blur() {
            //Alpine.store('ui').mobile_keyboard_active = false;
        }
    }));

    window.addEventListener('resize', (event) => {
        let is_mobile = !window.matchMedia('(min-width: 1024px)').matches;
        let was_mobile = Alpine.store("ui").is_mobile;

        if (is_mobile && !was_mobile) {
            Alpine.store('ui').is_mobile = true;
            window.dispatchEvent(new Event('hide-main-bar'));
            window.dispatchEvent(new Event('hide-user-bar'));
        } else if (was_mobile && !is_mobile) {
            Alpine.store('ui').is_mobile = false;
            window.dispatchEvent(new Event('show-main-bar'));
            window.dispatchEvent(new Event('show-user-bar'));
        }
    });

    if ('visualViewport' in window && Alpine.store("ui").is_mobile) {
        console.log("VVP detected");
        const VIEWPORT_VS_CLIENT_HEIGHT_RATIO = 0.75;
        window.visualViewport.addEventListener('resize', function (event) {
            console.log(event.target.height + " * " + event.target.scale + " / " + window.screen.height);

            if ((event.target.height * event.target.scale) / window.screen.height < VIEWPORT_VS_CLIENT_HEIGHT_RATIO) {
                console.log('keyboard is shown');
                Alpine.store("ui").mobile_keyboard_active = true;
            } else {
                console.log('keyboard is hidden');
                Alpine.store("ui").mobile_keyboard_active = false;
            }
        });
    }

});

function bbcode(text) {
    // BOLD
    text = text.replace(/\[b\]/gi, '<b>');
    text = text.replace(/\[\/b\]/gi, '</b>');

    // ITALICS
    text = text.replace(/\[i\]/gi, '<i>');
    text = text.replace(/\[\/i\]/gi, '</i>');

    // UNDERLINE
    text = text.replace(/\[u\]/gi, '<u>');
    text = text.replace(/\[\/u\]/gi, '</u>');

    // STRIKETHROUGH
    text = text.replace(/\[s\]/gi, '<del>');
    text = text.replace(/\[\/s\]/gi, '</del>');

    // LIST
    text = text.replace(/(\n?)\[list\](\n?)/gi, '<ul class="list-disc list-inside">');
    text = text.replace(/(\n?)\[\/list\](\n?)/gi, '</ul>');

    // LI
    text = text.replace(/\[\*\]/gi, '<li>');

    // IMAGE SRC
    text = text.replace(/\[img\](mailto:)?(\S+?)(\.jpe?g|\.gif|\.png)\[\/img\]/gi, '<img src=slate$2$3slate border=0 alt=slate$1$2$3slate>');

    // FONT SIZE
    text = text.replace(/\[size=(\d{1,2})\](.*?)\[\/size\]/gi, '<span class="text-$1px">$2</span>');

    // FONT COLOR
    text = text.replace(/\[color=(\S+?)\](.*?)\[\/color\]/gi, '<span class="font-$1-800">$2</span>');

    // HYPERLINK
    text = text.replace(/\[url\](http|https|ftp)(:\/\/\S+?)\[\/url\]/gi, '<a href="$1$2" class="link" target="_blank" rel="noopener noreferrer">$1$2</a>');
    text = text.replace(/\[url\](\S+?)\[\/url\]/gi, '<a href=slatehttps://$1slate class="link" target="_blank" rel="noopener noreferrer">$1</a>');
    text = text.replace(/\[url=(http|https|ftp)(:\/\/\S+?)\](.*?)\[\/url\]/gi, '<a href="$1$2" class="link" target="_blank" rel="noopener noreferrer">$3</a>');
    text = text.replace(/\[url=(\S+?)\](\S+?)\[\/url\]/gi, '<a href=slatehttps://$1slate class="link" target="_blank" rel="noopener noreferrer">$2</a>');

    // EMAIL LINK
    text = text.replace(/\[email\](\S+?@\S+?\.\S+?)\[\/email\]/gi, '<a href="mailto:$1" class="link">$1</a>');
    text = text.replace(/\[email=(\S+?@\S+?\.\S+?)\](.*?)\[\/email\]/gi, '<a href=slatemailto:$1slate class="link">$2</a>');

    // QUOTE
    text = text.replace(/\[quote\](\n?)(.*?)\[\/quote\](\n?)/gi, '<div class="quote">$2</div>');
    text = text.replace(/\[quote=(.*?)\](\n?)(.*?)\[\/quote\](\n?)/gi, '<div class="quote"><p class="quote-ref">$1 wrote:</p>$3</div>');

    // CODE
    text = text.replace(/\[code\](\n?)(.*?)\[\/code\](\n?)/gi, '<pre><p class="code-title">Code:</p><code>$2</code></pre>');

    return text;
}