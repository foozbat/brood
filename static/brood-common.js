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
});