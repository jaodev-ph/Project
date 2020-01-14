// import tippy from 'tippy.js';


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      // plugins: [ 'dayGrid' ],
      // defaultDate: '2019-02-01',


    //   eventRender: function(info) {
    //     var tooltip = new Tooltip(info.el, {
    //     title: info.event.extendedProps.description,
    //     placement: 'top',
    //     trigger: 'hover',
    //     container: 'body'
    //   });
    // },


      // eventRender: function(event, element) {
      //   $(element).tooltip({title: event.title,
      //             content: event.description,
      //             container: 'body',
      //             delay: { "show": 500, "hide": 300 }
      //   });
      // },

      // eventRender: function(info) {
      //   var stooltip = new Tooltip( info.el, {
      //   placement: 'bottom',
      //   container: document.body,
      //   html: true,
      //   title: 'something',
      //   trigger: 'hover',
      //   template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div> <div class="tooltip-inner"></div> </div>'.trim(),
      //    });
      // },


       eventRender: function(info) {
        // var tooltip = new Tooltip( info.el, {
        // placement: 'bottom',
        // container: document.body,
        // html: true,
        // title: 'something',
        // trigger: 'hover',
        // template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div> <div class="tooltip-inner"></div> </div>'.trim(),
        //  });
        var tooltip  = new tippy( info.el, {
        content: info.event.extendedProps.description,
        arrow: true,
        // arrowType: 'round', 
        interactive: true,
        // theme: 'light-border',
        // followCursor: 'true'
        });
      },


      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: '../public/imms/calendar.json'

    });

    calendar.render();
  });