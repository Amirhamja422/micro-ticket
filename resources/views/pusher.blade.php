<x-master>
    <x-slot name="title">Ticket</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Ticket List' btnVisible='1' btnName='Create Ticket' btnClass='info'
                    btnIcon='person-plus-fill'>
                    <div class="table-responsive">
                        <style>
                            table.table-bordered.dataTable tbody th,
                            table.table-bordered.dataTable tbody td {
                                border-bottom-width: 0;
                                text-wrap: wrap;
                            }
                        </style>
                        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Channel</th>
                                    <th>Subject</th>
                                    <th>status</th>
                                    <th>Assign Person</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </x-widgets.card-component>
            </div>
        </div>
        <!--end row-->
    </x-slot>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @push('js')
        <script>
      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      // var pusher = new Pusher('fd6b8cf3b157ab605bbc', {
      //   cluster: 'ap2'
      // });

      // var channel = pusher.subscribe('post.created');
      // channel.bind('form-submitted', function(data) {
      //   var testData = JSON.stringify(data.name);
      //   alert(testData);
      //   toastr.success("Record Updated", "Successfully Updated");

      // });
      // return false;
      Echo.channel('post.created')
      .listen('TicketNotification', (e) => {
          alert(e.message);
      });
      //   </script>
    @endpush
  </x-master>

  {{--

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
     Pusher.logToConsole = true;
    var pusher = new Pusher('b23d71886d55f985f153', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function(data) {
      if (data && data.post && data.post.author && data.post.title) {
        toastr.success('New Post Created', 'Author: ' + data.post.author + '<br>Title: ' + data.post.title, {
          timeOut: 0,
          extendedTimeOut: 0,
        });
      } else {
        console.error('Invalid data structure received:', data);
      }
    });
  </script>

  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
    $(document).ready(function(){
      toastr.success("Record Updated", "Successfully Updated");
      });
    </script>

  --}}

