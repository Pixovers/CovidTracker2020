

    var datapicker = flatpickr('#flatpickr', {
        onChange: function(selectedDates, dateStr, instance) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            let url = "./.?date=" + encodeURI(dateStr);
        
            if( urlParams.get('regione') ) {
                url += "&regione=" + urlParams.get('regione');
            }
            
            
            window.location.href = url;
        },

        onClose: null,

        onOpen: null,

        onReady: null

    });
