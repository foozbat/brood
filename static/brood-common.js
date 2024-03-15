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
        active_main_bar_menu: 'groups',

        init() {
            this.is_mobile = !window.matchMedia('(min-width: 1024px)').matches;
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
            Alpine.store('ui').mobile_keyboard_active = Alpine.store('ui').is_mobile;
        },
        blur() {
            Alpine.store('ui').mobile_keyboard_active = false;
        }
    }));

    window.addEventListener('resize', () => {
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
});