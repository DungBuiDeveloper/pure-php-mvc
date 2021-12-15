$(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      weekNumbers: true,
      eventLimit: true, // allow "more" link when too many events
      events: 'https://fullcalendar.io/demo-events.json',
      editable: true,
      eventRender: function(event, element) {
            element.append( "<span class='closeon'>X</span>" );
            element.find(".closeon").click(function() {
            $('#calendar').fullCalendar('removeEvents',event._id);
            });
        },
        eventClick: function(calEvent, jsEvent, view) {
            var title = prompt('Event Title:', calEvent.title, { buttons: { Ok: true, Cancel: false} });
            if (title){
                calEvent.title = title;
                $('#calendar').fullCalendar('updateEvent',calEvent);
            }
        }
    });
  
  });