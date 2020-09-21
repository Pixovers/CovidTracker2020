

    var datapicker = flatpickr('#flatpickr', {
        onChange: function(selectedDates, dateStr, instance) {
            window.location.href = "./.?date=" + encodeURI(dateStr);
        },

        onClose: null,

        onOpen: null,

        onReady: null

    });
