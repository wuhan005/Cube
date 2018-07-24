/*!
 * Beagle v1.5.0
 * https://foxythemes.net
 *
 * Copyright (c) 2018 Foxy Themes
 */

var App = (function () {
  'use strict';
  
  App.pageCalendar = function( ){


    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/

    $('#calendar').fullCalendar({
      header: {
        left: 'title',
        center: '',
        right: 'month,agendaWeek,agendaDay, today, prev,next',
      },
      defaultDate: '2016-06-12',
      editable: true,
      eventLimit: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      },
      events: [
          
      ]
    });

  };

  return App;
})(App || {});
