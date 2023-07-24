<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Task') }}
        </h2>
    </x-slot>

    <style>
        span.select2-container {
            width: 100% !important;
        }
    </style>
    <div class="container mt-5">
        <nav x-data="{ open: false }" class="border-b border-gray-100 mb-3">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end h-16">
                    <div class="flex">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @role('admin')
                            <x-nav-link :href="route('assign-task')" :active="request()->routeIs('assign-task')">
                                {{ __('Calendar View') }}
                            </x-nav-link>
                            @endrole
                            @role('admin')
                            <x-nav-link :href="route('task.index')" :active="request()->routeIs('task.index')">
                                {{ __('Table View') }}
                            </x-nav-link>
                            @endrole
                        </div>
                    </div>


                </div>
            </div>
        </nav>
        <div id='calendar'></div>
    </div>
    
    <x-primary-button id="defaultModalBtn" class="hidden" x-data="" x-on:click.prevent="$dispatch('open-modal', 'defaultModal')"></x-primary-button>
    <x-modal name="defaultModal">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-lg font-medium text-gray-900">
                    Add Task
                </h1>
            </div>
            <div class="space-y-6">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Users</label>
                        <select id="userEvent" class="block w-full js-example-basic-single" multiple name="user_id[]">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="inputPassword4" class="form-label">Task Description</label>
                        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_description" name="description"> </textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="inputEmail4" class="form-label">Task Type</label>
                        <select name="task_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="task_type">
                            <option value="">Select Task Type</option>
                            <option value="0">Daily</option>
                            <option value="1">Weekly</option>
                            <option value="2">Monthly</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3" x-data="{option: 'end_date', s: ''}">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="inputCity" class="form-label" x-text="option === 'end_date'? 'End Date': 'Duration'">End Date</label>
                                <input x-show="option === 'end_date'" type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_end_date" name="end_date">
                                <div class="flex items-center gap-2">
                                    <input x-show="option !== 'end_date'" x-on:input="s = $event.target.value > 1? 's': ''" type="number" id="date_duration" name="date_duration" placeholder="Duration" class="grow border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <select x-show="option !== 'end_date'" id="date_duration_unit" name="date_duration_unit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                        <option value="day" x-text="'day' + s"></option>
                                        <option value="week" x-text="'week' + s"></option>
                                        <option value="month" x-text="'month' + s"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="block form-label" x-text="option === 'end_date'? 'Change to Duration': 'Change to End Date'">Option</label>
                                <select x-on:change="option = $event.target.value" id="date_option" name="date_option" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-2.5 block w-full">
                                    <option value="end_date">End Date</option>
                                    <option value="duration">Duration</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3" x-data="{option: 'time', s: ''}">
                        <div class="row">
                            <div x-show="option === 'time'" class="col-md-4">
                                <label for="inputCity" class="form-label">Start Time</label>
                                <input type="time" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_time" name="time">
                            </div>
                            <div x-show="option === 'time'" class="col-md-4">
                                <label for="inputCity" class="form-label">End Time</label>
                                <input type="time" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_end_time" name="end_time">
                            </div>
                            <div x-show="option !== 'time'" class="col-md-8">
                                <label for="inputCity" class="form-label">Time Duration</label>
                                <div class="flex items-center gap-2">
                                    <input type="number" x-on:input="s = $event.target.value > 1? 's': ''" name="time_duration" id="time_duration" placeholder="Duration" class="grow border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <select name="time_duration_unit" id="time_duration_unit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                        <option value="min" x-text="'minute' + s"></option>
                                        <option value="hr" x-text="'hour' + s"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="block form-label" x-text="option === 'time'? 'Change to Duration': 'Change to Time'">Option</label>
                                <select x-on:change="option = $event.target.value" name="time_option" id="time_option" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-2.5 block w-full">
                                    <option value="time">Time</option>
                                    <option value="duration">Duration</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="color" class="form-label">Select Color</label>
                        <input type="color" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_color" name="color">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" id="defaultModalCloseBtn">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button type="button" class="ml-3" onclick="submitForm()" id="submitForm">
                        Submit
                    </x-primary-button>
                </div>
            </div>
        </div>
    </x-modal>

    <!-- The Edit modal -->
    @foreach ($tasks as $task)
    <x-primary-button id="editModalBtn{{ $task->id }}" class="hidden" x-data="" x-on:click.prevent="$dispatch('open-modal', 'editModal{{ $task->id }}')"></x-primary-button>

    <x-modal name="editModal{{ $task->id }}" focusable>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-lg font-medium text-gray-900">
                    Edit Task
                </h1>
                <x-danger-button type="button" onclick="deleteTask({{ $task->id }})">Delete</x-danger-button>
            </div>
            <div class="space-y-6">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Users</label>
                        <select class="block w-full js-example-basic-single" multiple name="user_id[]">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $task->users->contains($user)? 'selected': '' }}>{{ $user->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="inputPassword4" class="form-label">Task Description</label>
                        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_description" name="description">{{ $task->task_description }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="inputEmail4" class="form-label">Task Type</label>
                        <select name="task_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="task_type">
                            <option value="">Select Task Type</option>
                            <option value="0" {{ $task->task_type == "0"? 'selected': '' }}>Daily</option>
                            <option value="1" {{ $task->task_type == "1"? 'selected': '' }}>Weekly</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputCity" class="form-label">Task Time</label>
                        <input type="time" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_time" name="time" value="{{ $task->task_time }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="inputCity" class="form-label">Task End Date</label>
                        <input type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="event_end_date" name="end_date" value="{{ $task->end_date }}">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" id="closeEditBtn{{ $task->id }}">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button type="button" class="ml-3" onclick="submitForm()">
                        Submit
                    </x-primary-button>
                </div>
            </div>
        </div>
    </x-modal>
    @endforeach

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Select",
                allowClear: true
            });

        });

        function initSelect2(selecter) {
            $(selecter).select2({
                placeholder: "Select",
                allowClear: true
            });
        }
    </script>
    <script type="text/javascript">
        /*------------------------------------------
        --------------------------------------------
        Get Site URL
        --------------------------------------------
        --------------------------------------------*/
        var SITEURL = "{{ url('/') }}";

        var calendar = null;

        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            CSRF Token Setup
            --------------------------------------------
            --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            FullCalender JS Code
            --------------------------------------------
            --------------------------------------------*/
            calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    // right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'

                },

                navLinks: true,
                editable: true,
                events: "getevent",
                displayEventTime: false,
                events: SITEURL + "/assign-task",
                eventRender: function(event, element, view) {
                        element.find('.fc-title').html(event.title);
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    }

                    ,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    openModal(start, end, allDay);
                },

                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    // console.log(event)

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            description: event.title,
                            task_date: start,
                            end_date: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },

                eventClick: function(event) {
                    $('#editModalBtn' + event.id).click();
                }
            });
            // Function to open the custom modal
            function openModal(start, end, allDay) {
                const modal = document.getElementById('defaultModalBtn').click();
                selectedStart = start;
                selectedEnd = end;
                selectedAllDay = allDay;
            }

            // Function to close the custom modal
            $('#closeModel').click(function() {
                const modal = document.getElementById('defaultModal');
                modal.classList.add('hidden');

            })

            function closeModal() {
                const modal = document.getElementById('defaultModal');
                modal.classList.add('hidden');
            }


            // Function to handle form submission inside the modal
            $('#submitForm').click(function() {
                const user_id = $('.js-example-basic-single').find(':selected');
                // console.log(user_id[0]);
                let users = [];
                for (let i = 0; i < user_id.length; i++) {
                    users[i] = user_id[i].value;
                }

                const description = document.getElementById('event_description').value;
                const task_type = document.getElementById('task_type').value;
                const date_option = document.getElementById('date_option').value;
                const task_end_date = document.getElementById('event_end_date').value;
                const date_duration = document.getElementById('date_duration').value;
                const date_duration_unit = document.getElementById('date_duration_unit').value;
                const time_option = document.getElementById('time_option').value;
                const task_time = document.getElementById('event_time').value;
                const task_end_time = document.getElementById('event_end_time').value;
                const time_duration = document.getElementById('time_duration').value;
                const time_duration_unit = document.getElementById('time_duration_unit').value;
                const color = document.getElementById('event_color').value;
                console.log(color)
                // console.log(user_id , description , task_type , task_time);
                if (user_id) {
                    var start = $.fullCalendar.formatDate(selectedStart, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(selectedEnd, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + "/fullcalenderAjax",
                        data: {
                            users: users,
                            description: description,
                            task_type: task_type,
                            date_option: date_option,
                            end: task_end_date,
                            date_duration: date_duration,
                            date_duration_unit: date_duration_unit,
                            time_option: time_option,
                            time: task_time,
                            task_end_time: task_end_time,
                            time_duration: time_duration,
                            time_duration_unit: time_duration_unit,
                            color: color,
                            start: start,
                            type: 'add'
                        },
                        type: "POST",
                        success: function(data) {
                            console.log(data)
                            displayMessage("Event Created Successfully");

                            calendar.fullCalendar('renderEvent', {
                                id: data.event.id,
                                title: 'Task :' + data.event.task_description + '<br>' + 'UserName :' + data.event.username + '<br>' + 'Time :' + data.event.task_time,
                                start: data.event.task_date + ' ' + data.event.task_time,
                                end: data.event.end_date + ' 11:59:59',
                                backgroundColor: data.event.color
                                // , allDay: selectedAllDay
                            }, true);

                            const modal = document.getElementById('defaultModalCloseBtn').click();
                            // modal.classList.add('hidden');
                            // $('#closeModal').close();
                            calendar.fullCalendar('unselect');
                            $(document.body).append($(decodeHtml(data.modalHTML)));
                            
                            initSelect2('#select2' + data.event.id);
                        }
                    });
                }
            })

            @foreach($tasks as $task)
            calendar.fullCalendar('renderEvent', {
                id: '{{ $task->id }}',
                title: 'Task : {{ $task->task_description }} <br> Task Time : {{ $task->task_time }}', // Use <br> to create a line break
                start: '{{ $task->task_date . " " . $task->task_time }}',
                end: '{{ $task->end_date  . " 11: 59: 59"}}',
                backgroundColor: '{{ $task->color }}'
                // Other event properties...
            }, true);
            @endforeach

        });

        function deleteTask(id) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: id,
                        type: 'delete'
                    },
                    success: function(response) {
                        calendar.fullCalendar('removeEvents', id);
                        console.log($('#editModal' + id));
                        console.log($('#editModalBtn' + id));
                        $('#closeEditBtn' + id).click();
                        displayMessage("Event Deleted Successfully");
                    }
                });
            }
        }

        /*------------------------------------------
        --------------------------------------------
        Toastr Success Code
        --------------------------------------------
        --------------------------------------------*/
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

        function decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }
    </script>

</x-app-layout>