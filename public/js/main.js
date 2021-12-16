$(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      weekNumbers: true,
      eventLimit: true, // allow "more" link when too many events
      events: 'http://oop.test/home/getList',
      editable: true,
      selectable: true,
      select: function(start, end, allDay) {
        var title = prompt('Event Title:');
        if (title) {
            $('#calendar').fullCalendar('renderEvent',
                {
                    title: title,
                    start: start,
                    end: end,
                    allDay: allDay
                },
                true // make the event "stick"
            );
            // console.log({ // re-use event's data
            //     title: title,
            //     start: start,
            //     end: end,
            //     allDay: allDay
            // });
         console.log({ // re-use event's data
            title: title,
            start: moment(start).format('Y-MM-DD HH:mm:ss'),
            end: moment(end).format('Y-MM-DD HH:mm:ss'),
            allDay: allDay
        });
            /**
             * ajax call to store event in DB
             */
            // jQuery.post(
            //     "event/new" // your url
            //     , { // re-use event's data
            //         title: title,
            //         start: moment(start).format('Y-MM-DD HH:mm:ss'),
            //         end: moment(end).format('Y-MM-DD HH:mm:ss'),
            //         allDay: allDay
            //     }
            // );
        }
        $('#calendar').fullCalendar('unselect');
    } ,
      eventRender: function(event, element) {
            element.append( "<span class='closeon'>X</span>" );
            $selectedStatus = `<button type="button" class="btn btn-info btn-lg status" data-toggle="modal" data-target="#myModal">Open Modal</button>`;
            element.append( $selectedStatus );
           
            element.find(".closeon").click(function() {
                $('#calendar').fullCalendar('removeEvents',event._id);
            });

            element.find(".status").click(function(e) {
                e.stopPropagation();
                $('#myModal').modal("show");
                $(`.radioStatus input[value='${event.status}']`).prop('checked',true);
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




  