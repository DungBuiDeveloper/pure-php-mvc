$(function () {
    let baseUrl = $('base').attr('href');

    function editTodoSetting(event) {
        /**
        * ajax call to Edit event in DB
        */
        let settings = {
            "url": `${baseUrl}todo/edit`,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": event

        };
        return settings;
    }
    $(document).on('change', '.radioStatus input', function () {
        let status = $(".radioStatus input[name='status']:checked").val();
        let event = JSON.parse($('.dataEvent').val());
        event.status = status;
        event.start = moment(event.start).format('Y-MM-DD HH:mm:ss');
        event.end = moment(event.end).format('Y-MM-DD HH:mm:ss');
        
        $.ajax(editTodoSetting(event)).done(function (response) {
            $('#calendar').fullCalendar( 'refetchEvents' );
        }).fail(function (jqXHR, textStatus) {
            alert('Some Thing Wrong!');
            location.reload();
        });
    });


    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        weekNumbers: true,
        eventLimit: true, // allow "more" link when too many events
        events: `${baseUrl}todo`,
        editable: true,
        selectable: true,
        droppable: true, 
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {

                let newEvent = { // re-use event's data
                    title: title,
                    start: moment(start).format('Y-MM-DD HH:mm:ss'),
                    end: moment(end).format('Y-MM-DD HH:mm:ss')
                };
                /**
                 * ajax call to store event in DB
                 */
                var settings = {
                    "url": `${baseUrl}todo/add`,
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": newEvent
                };

                $.ajax(settings).done(function (response) {
                    if (!JSON.parse(response)?.error) {
                        let res = JSON.parse(response);
                        newEvent.id = res?.id
                        $('#calendar').fullCalendar('renderEvent', newEvent);
                        $('#calendar').fullCalendar('unselect');
                    } else {
                        alert(JSON.parse(response)?.error[0]);
                    }
                }).fail(function (jqXHR, textStatus) {
                    alert('Some Thing Wrong!');
                    location.reload();
                });

            }

        },
        eventRender: function (event, element) {
            element.append("<span style='margin-right:5px;' class='closeon glyphicon glyphicon-trash text-danger'></span>");
            $selectedStatus = `<span class="glyphicon glyphicon-edit statusPopup"></span>`;
            element.append($selectedStatus);

            element.find(".closeon").click(function (e) {
                e.stopPropagation();
                var settings = {
                    "url": `${baseUrl}todo/delete`,
                    "method": "DELETE",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": {
                        id: event.id
                    }
                };

                $.ajax(settings).done(function (response) {
                    $('#calendar').fullCalendar('removeEvents', event._id);
                }).fail(function (jqXHR, textStatus) {
                    alert('Some Thing Wrong!');
                    location.reload();
                });
            });

            element.find(".statusPopup").click(function (e) {
                e.stopPropagation();
                $('#modalStatus').modal("show");
                $(`.radioStatus input[value='${event.status}']`).prop('checked', true);

                let newEvent = {
                    'title': event.title,
                    'id': event.id,
                    'status': event.status,
                    'start': moment(event.start).format('Y-MM-DD HH:mm:ss'),
                    'end': moment(event.end).format('Y-MM-DD HH:mm:ss'),
                    '_id': event._id
                };
                $('.dataEvent').val(JSON.stringify(newEvent));
            });
        },
        eventClick: function (calEvent, jsEvent, view) {
            var title = prompt('Event Title:', calEvent.title, { buttons: { Ok: true, Cancel: false } });
            if (title) {
                $.ajax(editTodoSetting({
                    'title': title,
                    'id': calEvent.id,
                    'status': calEvent.status,
                    'start': moment(calEvent.start).format('Y-MM-DD HH:mm:ss'),
                    'end': moment(calEvent.end).format('Y-MM-DD HH:mm:ss')
                })).done(function (response) {
                    if (!JSON.parse(response)?.error) {
                        calEvent.title = title;
                        $('#calendar').fullCalendar('updateEvent', calEvent);
                    } else {
                        alert(JSON.parse(response)?.error[0]);
                    }
                }).fail(function (jqXHR, textStatus) {
                    alert('Some Thing Wrong!');
                    location.reload();
                });

            }
        },
        eventDrop: function (calEvent) {
            $.ajax(editTodoSetting({
                'title': calEvent.title,
                'id': calEvent.id,
                'status': calEvent.status,
                'start': moment(calEvent.start).format('Y-MM-DD HH:mm:ss'),
                'end': moment(calEvent.end).format('Y-MM-DD HH:mm:ss')
            })).done(function (response) {
                if (!JSON.parse(response)?.error) {
                    $('#calendar').fullCalendar('updateEvent', calEvent);
                } else {
                    alert(JSON.parse(response)?.error[0]);
                }
            }).fail(function (jqXHR, textStatus) {
                alert('Some Thing Wrong!');
                location.reload();
            });
            
        }

    });

});




