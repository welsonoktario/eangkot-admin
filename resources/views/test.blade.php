<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <h1>Members:</h1>
  <ul id="members"></ul>

  <h2>Lokasi Angkot:</h2>
  <p id="lokasi"></p>

  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(function() {
      const channel = window.Pusher.subscribe(`presence-angkot.1`)

      channel.bind('angkot.lokasi-updated', (data) => {
        const lokasi = data.angkot.lokasi.coordinates;
        $("#lokasi").text(`Lat: ${lokasi[1]}, Long: ${lokasi[0]}`);
      });
      channel.bind("pusher:member_added", (member) => {
        $('#members').append(`<li id="user-${member.info.id}">${member.info.nama}</li>`);
      });

      channel.bind("pusher:member_removed", (member) => {
        $(`#user-${member.info.id}`).remove();
      });

      channel.bind("pusher:subscription_succeeded", (members) => {
        members.each((member) => {
          $('#members').append(`<li id="user-${member.info.id}">${member.info.nama}</li>`);
        });
      });
    });
  </script>
</body>

</html>
